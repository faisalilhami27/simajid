import React, {Component, Fragment} from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import {ROUTE} from "./Route";
import '../../../public/js/dataTables.bootstrap4.min';
import '../../../public/js/jquery-confirm';
import '../../../public/js/script';
import '../../../public/js/select2.min';
import '../../css/style.css';

const $ = require('jquery');
$.Datatable = require('datatables.net');

export default class UserPengurus extends Component {
    constructor(props) {
        super(props);
        this.state = {
            id: 0,
            pengurus: '',
            username: '',
            password: '',
            level: [],
            status: '',
            cmb_pengurus: [],
            cmb_level: [],
            edit: false,
        };

        this.openModal = this.openModal.bind(this);
        this.inputChange = this.inputChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleChange = this.handleChange.bind(this);
        this.reloadLevel = this.reloadLevel.bind(this);
        this.reloadPengurus = this.reloadPengurus.bind(this);
        this.showHidePassword = this.showHidePassword.bind(this);
    }

    inputChange(e) {
        this.setState({[e.target.name]: e.target.value});
    }

    reloadLevel() {
        axios({
            method: 'GET',
            url: ROUTE + 'user/getLevel',
            dataType: 'JSON'
        })
            .then(res => {
                this.setState({
                    cmb_level: res.data.list
                })
            })
    }

    reloadPengurus() {
        axios({
            method: 'GET',
            url: ROUTE + 'user/getPengurus',
            dataType: 'JSON'
        })
            .then(res => {
                this.setState({
                    cmb_pengurus: res.data.list
                })
            })
    }

    handleDelete(id) {
        $.confirm({
            content: 'Data yang dihapus tidak akan dapat dikembalikan.',
            title: 'Apakah yakin ingin menghapus ?',
            type: 'red',
            typeAnimated: true,
            buttons: {
                cancel: {
                    text: 'Batal',
                    btnClass: 'btn-danger',
                    keys: ['esc'],
                    action: function () {
                    }
                },
                ok: {
                    text: '<i class="icon icon-trash"></i> Hapus',
                    btnClass: 'btn-warning',
                    action: function () {
                        axios({
                            method: 'delete',
                            url: ROUTE + 'user/delete',
                            data: {
                                id: id
                            },
                            dataType: 'json',
                            config: {headers: {'Content-Type': 'multipart/form-data'}}
                        }).then(function (res) {
                            notification(res.data.status, res.data.msg);
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        }).catch(function (res) {
                            console.log(res);
                        })
                    }
                }
            }
        });
    }

    handleSubmit(e) {
        e.preventDefault();
        let  pengurus = this.state.pengurus,
            username = this.state.username,
            password = this.state.password,
            level = this.state.level,
            status = this.state.status,
            sendData = "pengurus=" + pengurus + "&username=" + username + "&password=" +password + "&level=" + level + "&status=" + status;

        if (this.state.edit === false) {
            axios({
                method: 'post',
                url: ROUTE + 'user/insert',
                data: sendData,
                dataType: 'JSON',
                config: {headers: {'Content-Type': 'multipart/form-data'}}
            })
                .then(function (res) {
                    $('#infoModalColoredHeader').remove();
                    notification(res.data.status, res.data.msg);
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                })
                .catch(function (resp) {
                    if (_.has(resp.response.data, 'errors')) {
                        _.map(resp.response.data.errors, function (val, key) {
                            $('#' + key + '-error').html(val[0]).fadeIn(1000).fadeOut(5000);
                        })
                    }
                    alert(resp.response.data.message)
                });
        } else {
            let id = this.state.id;
            axios({
                method: 'put',
                url: ROUTE + 'user/update',
                data: "level=" + level + "&status=" + status + '&id=' + id,
                dataType: 'JSON',
                config: {headers: {'Content-Type': 'multipart/form-data'}}
            })
                .then(function (res) {
                    $('#infoModalColoredHeader').remove();
                    notification(res.data.status, res.data.msg);
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                })
                .catch(function (resp) {
                    if (_.has(resp.response.data, 'errors')) {
                        _.map(resp.response.data.errors, function (val, key) {
                            $('#' + key + '-error').html(val[0]).fadeIn(1000).fadeOut(5000);
                        })
                    }
                    alert(resp.response.data.message)
                });
        }
    }

    handleResetPassword(id) {
        $.confirm({
            content: 'Apakah yakin akan mereset password akun ini ?',
            title: 'Reset Password',
            type: 'red',
            typeAnimated: true,
            buttons: {
                cancel: {
                    text: 'Batal',
                    btnClass: 'btn-danger',
                    keys: ['esc'],
                    action: function () {
                    }
                },
                ok: {
                    text: '<i class="icon icon-repeat"></i> Reset',
                    btnClass: 'btn-success',
                    action: function () {
                        axios({
                            method: 'put',
                            url: ROUTE + 'user/reset',
                            data: "id=" + id,
                            dataType: 'json',
                            config: {headers: {'Content-Type': 'multipart/form-data'}}
                        }).then(function (res) {
                            notification(res.data.status, res.data.msg);
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        }).catch(function (res) {
                            console.log(res);
                        })
                    }
                }
            }
        });
    }

    handleEdit(id) {
        const self = this;
        this.$tl = $(this.tl);
        this.$pa = $(this.pa);
        this.$pe = $(this.pe);
        this.$us = $(this.us);
        this.$lv = $(this.lv);
        this.$pa.hide();
        this.$pe.hide();
        this.$us.hide();
        axios({
            method: 'post',
            url: ROUTE + 'user/get',
            data: "id=" + id,
            dataType: 'json',
            config: {headers: {'Content-Type': 'multipart/form-data'}}
        }).then(function (res) {
            if (res.data.status == 200) {
                this.setState({
                    id: res.data.user.id,
                    level: res.data.item,
                    status: res.data.user.status,
                    edit: true
                });
                self.$tl.html("Update Data User Pengurus");
                self.$lv.select2().val(res.data.item).trigger('change')
            } else {
                console.log(res.data.msg);
            }
        }.bind(this)).catch(function (res) {
            console.log(res);
        })
    }

    checkUsername(e) {
        const self = this;
        this.$ur = $(this.ur);
        this.$bt = $(this.bt);
        let username = e.target.value;
        axios({
            method: 'post',
            url: ROUTE + 'user/cekUsername',
            data: "username=" + username,
            dataType: 'json',
            config: {headers: {'Content-Type': 'multipart/form-data'}}
        }).then(function (res) {
            if (res.data.status == 200) {
                self.$ur.html("");
                self.$bt.removeAttr('disabled');
            } else {
                self.$ur.html(res.data.msg);
                self.$ur.css("color", "red");
                self.$bt.attr('disabled', 'disabled');
            }
        }.bind(this)).catch(function (res) {
            console.log(res);
        })
    }

    openModal() {
        this.setState({
            edit: false
        });

        this.$pa = $(this.pa);
        this.$pe = $(this.pe);
        this.$us = $(this.us);
        this.$lv = $(this.lv);
        this.$tl = $(this.tl);
        this.$tl.html("Tambah Data User Pengurus");

        if (this.state.edit) {
            this.$pa.show();
            this.$pe.show();
            this.$us.show();
            this.$lv.val('').trigger('change')
        }
    }

    handleChange(e) {
        var options = e.target.options;
        var length = options.length
        var value = [];
        for (var i = 0; i < length; i++) {
            if (options[i].selected) {
                value.push(options[i].value);
            }
        }
        this.setState({
            level: value
        });
    }

    showHidePassword() {
        this.$ch = $(this.ch);
        const self = this;
        this.$sh = $(this.sh);
        this.$ch.change(function () {
            if ($(this).is(':checked')) {
                self.$sh.attr('type', 'text');
            } else {
                self.$sh.attr('type', 'password');
            }
        })
    }

    componentDidMount() {
        this.reloadPengurus();
        this.reloadLevel();

        this.$p = $(this.p);
        this.$p.select2({
            width: '100%'
        });
        this.$p.on('change', this.inputChange);

        this.$lv = $(this.lv);
        this.$lv.select2({
            width: '100%'
        });
        this.$lv.on('change', this.handleChange);

        var styles = {
            status: function (row, type, data) {
                if (data.status == 1) {
                    return "<center>" + "<span class='label label-primary'>Aktif</span>" + "</center>";
                } else {
                    return "<center>" + "<span class='label label-danger'>Tidak aktif</span>" + "</center>";
                }
            },
            level: function (row, type, data) {
                if (data.pengurus_role != null) {
                    const numRole = data.pengurus_role.length;
                    if (numRole > 2) {
                        return `Memiliki ${numRole} hak akses`
                    }

                    let arrRole = [];
                    _.each(data.pengurus_role, function (role) {
                        arrRole.push(role.role.nama)
                    });

                    return arrRole.join(', ');
                }
                return '-'
            }
        };

        this.$el = $(this.el);
        this.$el.DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            aLengthMenu: [[5, 10, 25, 100], [5, 10, 25, 100]],
            order: [],

            ajax: {
                "url": ROUTE + 'user/json',
                "type": "POST",
                "headers": {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                },
            },

            columns: [
                {data: 'DT_RowIndex'},
                {data: 'pengurus.nama'},
                {data: 'username'},
                {data: 'pengurus.email'},
                {data: 'nama_level', render: styles.level},
                {data: 'status', render: styles.status},
            ],

            columnDefs: [
                {
                    targets: 6,
                    data: null,
                    createdCell: (td, cellData, rowData, row, col) =>
                        ReactDOM.render(
                            <div>
                                <center>
                                    <button data-toggle="modal" data-target="#infoModalColoredHeader" className="btn btn-success btn-sm btn-edit" id={rowData.id} onClick={() => this.handleEdit(rowData.id)}><i className="icon icon-pencil-square-o"></i></button> <button className="btn btn-danger btn-sm" id={rowData.id} onClick={() => this.handleDelete(rowData.id)}><i className="icon icon-trash"></i></button> <button className="btn btn-warning btn-sm btn-edit" id={rowData.id} onClick={() => this.handleResetPassword(rowData.id)}><i className="icon icon-repeat"></i></button>
                                </center>
                            </div>, td
                        )
                }
            ]
        });
    }

    render() {
        return (
            <Fragment>
                <div className="layout-content-body">
                    <button className="btn btn-info btn-sm" type="button" data-toggle="modal"
                            data-target="#infoModalColoredHeader" onClick={this.openModal}
                            style={{marginBottom: '10px'}}><i className="icon icon-plus-circle"></i> Tambah
                    </button>
                    <div className="row gutter-xs">
                        <div className="col-xs-12">
                            <div className="card">
                                <div className="card-header">
                                    <strong>Daftar User Pengurus</strong>
                                </div>
                                <div className="card-body">
                                    <div className="table-responsive">
                                        <table id="demo-datatables"
                                               className="table table-striped table-hover table-nowrap dataTable"
                                               width="100%" ref={el => this.el = el}>
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Lengkap</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Level</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="infoModalColoredHeader" role="dialog" className="modal fade">
                    <div className="modal-dialog">
                        <div className="modal-content">
                            <div className="modal-header bg-primary">
                                <button type="button" className="close" data-dismiss="modal">
                                    <span aria-hidden="true">×</span>
                                    <span className="sr-only">Close</span>
                                </button>
                                <h4 className="modal-title-insert" ref={tl => this.tl = tl}>Tambah Data User Pengurus</h4>
                            </div>
                            <form className="form" method="post">
                                <div className="modal-body">
                                    <div className="form-group" ref={pe => this.pe = pe}>
                                        <label htmlFor="pengurus" className="form-label">Pengurus</label>
                                        <select id="pengurus" ref={p => this.p = p} name="pengurus" onChange={this.inputChange} value={this.state.pengurus} className="form-control">
                                            <option value="">-- Pilih Pengurus --</option>
                                            {this.state.cmb_pengurus.map((data, index) => {
                                                return (
                                                    <option key={index} value={data.id}>{data.nama}</option>
                                                )
                                            })}
                                        </select>
                                        <span className="text-danger">
                                            <strong id="pengurus-error"></strong>
                                        </span>
                                    </div>
                                    <div className="form-group" ref={us => this.us = us}>
                                        <label htmlFor="username">Username</label>
                                        <input id="username"
                                               name="username"
                                               className="form-control"
                                               type="text"
                                               onKeyUp={this.checkUsername.bind(this)}
                                               onChange={this.inputChange}
                                               value={this.state.username}
                                               placeholder="Masukan username" maxLength="60" autoComplete="off"/>
                                        <span className="text-danger">
                                            <strong ref={ur => this.ur = ur} id="username-error"></strong>
                                        </span>
                                    </div>
                                    <div className="form-group" ref={pa => this.pa = pa}>
                                        <label htmlFor="password">Password</label>
                                        <div className="input-group">
                                            <input className="form-control form-password"
                                                   id="password"
                                                   name="password"
                                                   ref={sh => this.sh = sh}
                                                   onChange={this.inputChange}
                                                   maxLength="12" minLength="8" type="password" placeholder="Password"/>
                                        <span className="input-group-addon">
                                            <label className="custom-control custom-control-danger custom-checkbox">
                                                <input ref={ch => this.ch = ch} onChange={this.showHidePassword} className="custom-control-input form-checkbox" type="checkbox"/>
                                                <span className="custom-control-indicator"></span>
                                                <span className="custom-control-label">Show</span>
                                            </label>
                                        </span>
                                        </div>
                                        <span className="text-danger">
                                            <strong id="password-error"></strong>
                                         </span>
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="level" className="form-label">Level</label>
                                        <select id="level" ref={lv => this.lv = lv} name="level" onChange={this.handleChange} value={this.state.level} className="form-control" multiple={true}>
                                            {this.state.cmb_level.map((data, index) => {
                                                return (
                                                    <option key={index} value={data.id}>{data.nama}</option>
                                                )
                                            })}
                                        </select>
                                        <span className="text-danger">
                                            <strong id="level-error"></strong>
                                        </span>
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="status" className="form-label">Status</label>
                                        <select id="status" name="status" onChange={this.inputChange} value={this.state.status} className="form-control">
                                            <option value="">-- Pilih Status --</option>
                                            <option value="1">Aktif</option>
                                            <option value="0">Tidak</option>
                                        </select>
                                        <span className="text-danger">
                                            <strong id="status-error"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div className="modal-footer">
                                    <button className="btn btn-default" data-dismiss="modal" type="button">Cancel
                                    </button>
                                    <button ref={bt => this.bt = bt} className="btn btn-primary" id="btn-insert-data" onClick={this.handleSubmit} type="submit">Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </Fragment>
        )
    }
}

if (document.getElementById('user_pengurus')) {
    ReactDOM.render(<UserPengurus/>, document.getElementById('user_pengurus'));
}
