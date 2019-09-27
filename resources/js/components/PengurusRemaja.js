import React, {Component, Fragment} from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import {ROUTE} from "./Route";
import script from './MyScript';

const $ = require('jquery');
$.Datatable = require('datatables.net');

export default class PengurusRemaja extends Component {
    constructor(props) {
        super(props);
        this.state = {
            id: 0,
            nama: '',
            email: '',
            no_hp: '',
            status: '',
            id_jabatan: '',
            cmb_jabatan: [],
            edit: false
        };

        this.openModal = this.openModal.bind(this);
        this.inputChange = this.inputChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
        this.reloadJabatan = this.reloadJabatan.bind(this);
    }

    inputChange(e) {
        this.setState({[e.target.name]: e.target.value});
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
                            url: ROUTE + 'pengurus/delete',
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
        let nama = this.state.nama,
            email = this.state.email,
            status = this.state.status,
            no_hp = this.state.no_hp,
            jabatan = this.state.id_jabatan,
            pengurus = 1,
            sendData = "nama=" + nama + "&email=" + email + "&no_hp=" + no_hp + "&status=" + status + "&id_pengurus=" + pengurus + "&id_jabatan=" + jabatan;

        if (this.state.edit === false) {
            axios({
                method: 'post',
                url: ROUTE + 'pengurus/insert',
                data: sendData,
                dataType: 'JSON',
                config: {headers: {'Content-Type': 'multipart/form-data'}}
            })
                .then(function (res) {
                    $('#infoModalColoredHeader').remove();
                    notification(res.data.status, res.data.msg);
                    // setTimeout(function () {
                    //     location.reload();
                    // }, 1000);
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
                url: ROUTE + 'pengurus/update',
                data: sendData + '&id=' + id,
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

    checkEmail(e) {
        this.$em = $(this.em);
        this.$bt = $(this.bt);
        let email = e.target.value;
        axios({
            method: 'post',
            url: ROUTE + 'pengurus/cekEmail',
            data: "email=" + email,
            dataType: 'json',
            config: {headers: {'Content-Type': 'multipart/form-data'}}
        }).then(res => {
            if (res.data.status === 200) {
                this.$em.html("");
                this.$bt.removeAttr('disabled');
            } else {
                this.$em.html(res.data.msg);
                this.$em.css("color", "red");
                this.$bt.attr('disabled', 'disabled');
            }
        }).catch(function (res) {
            console.log(res);
        })
    }

    checkPhoneNumber(e) {
        this.$ph = $(this.ph);
        this.$bt = $(this.bt);
        let phone = e.target.value;
        axios({
            method: 'post',
            url: ROUTE + 'pengurus/cekNoHp',
            data: "noHp=" + phone,
            dataType: 'json',
            config: {headers: {'Content-Type': 'multipart/form-data'}}
        }).then(res => {
            if (res.data.status === 200) {
                this.$ph.html("");
                this.$bt.removeAttr('disabled');
            } else {
                this.$ph.html(res.data.msg);
                this.$ph.css("color", "red");
                this.$bt.attr('disabled', 'disabled');
            }
        }).catch(function (res) {
            console.log(res);
        })
    }

    handleEdit(id) {
        this.$tl = $(this.tl);
        this.$m = $(this.m);
        axios({
            method: 'post',
            url: ROUTE + 'pengurus/get',
            data: "id=" + id,
            dataType: 'json',
            config: {headers: {'Content-Type': 'multipart/form-data'}}
        }).then(res => {
            if (res.data.status === 200) {
                this.setState({
                    id: res.data.list.id,
                    nama: res.data.list.nama,
                    email: res.data.list.email,
                    no_hp: res.data.list.no_hp,
                    status: res.data.list.status,
                    edit: true
                });
                this.$tl.html("Update Data Pengurus Remaja Mesjid");
                this.$m.select2().val(res.data.list.id_jabatan).trigger('change');
            } else {
                console.log(res.data.msg);
            }
        }).catch(function (res) {
            console.log(res);
        })
    }

    openModal() {
        this.setState({
            id: 0,
            nama: '',
            email: '',
            foto: '',
            no_hp: '',
            status: '',
            edit: false
        });

        this.$tl = $(this.tl);
        this.$tl.html("Tambah Data Pengurus Remaja Mesjid");
    }

    reloadJabatan() {
        axios({
            method: 'GET',
            url: ROUTE + 'pengurus/jabatan',
            dataType: 'JSON'
        })
            .then(res => {
                this.setState({
                    cmb_jabatan: res.data
                })
            })
    };

    componentDidMount() {
        this.reloadJabatan();
        this.$m = $(this.m);
        this.$m.select2({
            width: '100%'
        });
        this.$m.on('change', this.inputChange);

        var styles = {
            status: function (row, type, data) {
                if (data.status == 1) {
                    return '<span class="label label-success">Aktif</span>';
                } else {
                    return '<span class="label label-danger">Tidak Aktif</span>';
                }
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
                "url": ROUTE + 'pengurus/remaja/json',
                "type": "POST",
                "headers": {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                },
            },

            columns: [
                {data: 'DT_RowIndex'},
                {data: 'nama'},
                {data: 'email'},
                {data: 'no_hp'},
                {data: 'status', render: styles.status},
            ],

            columnDefs: [
                {
                    targets: 5,
                    data: null,
                    createdCell: (td, cellData, rowData, row, col) =>
                        ReactDOM.render(
                            <div>
                                <center>
                                    <button data-toggle="modal" data-target="#infoModalColoredHeader" className="btn btn-success btn-sm btn-edit" id={rowData.id} onClick={() => this.handleEdit(rowData.id)}><i className="icon icon-pencil-square-o"></i></button> <button className="btn btn-danger btn-sm" id={rowData.id} onClick={() => this.handleDelete(rowData.id)}><i className="icon icon-trash"></i></button>
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
                                    <strong>Daftar Pengurus</strong>
                                </div>
                                <div className="card-body">
                                    <div className="table-responsive">
                                        <table id="demo-datatables"
                                               className="table table-striped table-hover table-nowrap dataTable"
                                               width="100%" ref={el => this.el = el}>
                                            <thead>
                                            <tr>
                                                <th width="20px">No</th>
                                                <th>Nama Lengkap</th>
                                                <th>Email</th>
                                                <th>No HP</th>
                                                <th>Status Pengurus</th>
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
                                <h4 className="modal-title-insert" ref={tl => this.tl = tl}>Tambah Data Pengurus</h4>
                            </div>
                            <form className="form" method="post">
                                <div className="modal-body">
                                    <div className="form-group">
                                        <label htmlFor="nama">Nama Lengkap</label>
                                        <input id="nama" name="nama" className="form-control" type="text"
                                               placeholder="Masukan nama" maxLength="60"
                                               onChange={this.inputChange}
                                               value={this.state.nama}
                                               autoComplete="off"/>
                                        <span className="text-danger">
                                    <strong id="nama-error"></strong>
                                </span>
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="email">Email</label>
                                        <input id="email" name="email" className="form-control" type="text"
                                               placeholder="Masukan email" maxLength="60"
                                               onChange={this.inputChange}
                                               onKeyUp={this.checkEmail.bind(this)}
                                               value={this.state.email}
                                               autoComplete="off"/>
                                        <span className="text-danger">
                                    <strong ref={em => this.em = em} id="email-error"></strong>
                                </span>
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="no_hp">Nomor Handphone</label>
                                        <input id="no_hp" name="no_hp" className="form-control" type="text"
                                               placeholder="Masukan nomor hp" maxLength="15"
                                               onChange={this.inputChange}
                                               onKeyUp={this.checkPhoneNumber.bind(this)}
                                               value={this.state.no_hp}
                                               autoComplete="off"/>
                                        <span className="text-danger">
                                            <strong ref={ph => this.ph = ph} id="no_hp-error"></strong>
                                        </span>
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="id_jabatan">Jabatan</label>
                                        <select name="id_jabatan" ref={m => this.m = m} onChange={this.inputChange} value={this.state.id_jabatan} className="form-control">
                                            <option value="">-- Pilih Jabatan --</option>
                                            {this.state.cmb_jabatan.map((data, i) => {
                                               return(
                                                   <option key={i} value={data.id}>{data.nama}</option>
                                               )
                                            })}
                                        </select>
                                        <span className="text-danger">
                                            <strong id="id_jabatan-error"></strong>
                                        </span>
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="no_hp">Status</label>
                                        <select name="status" id="status" onChange={this.inputChange}
                                                value={this.state.status} className="form-control">
                                            <option value="">Pilih Status</option>
                                            <option value="1">Aktif</option>
                                            <option value="0">Tidak Aktif</option>
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

if (document.getElementById('pengurus-remaja')) {
    ReactDOM.render(<PengurusRemaja/>, document.getElementById('pengurus-remaja'));
}
