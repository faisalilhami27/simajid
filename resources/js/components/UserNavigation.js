import React, {Component, Fragment} from 'react';
import ReactDOM from 'react-dom';
import {ROUTE} from './Route';
import axios from 'axios';
import '../../css/style.css';
import '../../../public/js/dataTables.bootstrap4.min';
import '../../../public/js/jquery-confirm';
import '../../../public/js/script';
import '../../../public/js/select2.min';
import '../../../public/js/icheck.min';

const $ = require('jquery');
$.DataTable = require('datatables.net');

export default class UserNavigation extends Component {
    constructor(props) {
        super(props);
        this.state = {
            id: 0,
            id_user_level: '',
            id_menu: '',
            create: 0,
            read: 0,
            update: 0,
            delete: 0,
            cmb_role: [],
            cmb_menu: [],
            edit: false
        };

        this.openModal = this.openModal.bind(this);
        this.reloadLevel = this.reloadLevel.bind(this);
        this.reloadMenu = this.reloadMenu.bind(this);
        this.inputChange = this.inputChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleChange = this.handleChange.bind(this);
    }

    reloadLevel() {
        axios({
            method: 'GET',
            url: ROUTE + 'akses/getLevel',
            dataType: 'JSON'
        })
            .then(res => {
                this.setState({
                    cmb_role: res.data
                })
            })
    }

    reloadMenu() {
        axios({
            method: 'GET',
            url: ROUTE + 'akses/getNavigation',
            dataType: 'JSON'
        })
            .then(res => {
                this.setState({
                    cmb_menu: res.data
                })
            })
    }

    openModal() {
        this.setState({
            edit: false
        });

        this.$tl = $(this.tl);
        this.$rl = $(this.rl);
        this.$mn = $(this.mn);
        this.$tl.html("Tambah Data User Navigation");

        if (this.state.edit) {
            this.$rl.show();
            this.$mn.show();
        }
    }

    inputChange(e) {
        this.setState({[e.target.name]: e.target.value});
    }

    handleEdit(id) {
        const self = this;
        this.$cr = $(this.cr);
        this.$rd = $(this.rd);
        this.$up = $(this.up);
        this.$dl = $(this.dl);
        this.$tl = $(this.tl);
        this.$rl = $(this.rl);
        this.$mn = $(this.mn);
        this.$rl.hide();
        this.$mn.hide();
        this.$tl.html("Update Data User Navigation");

        axios({
            method: 'post',
            url: ROUTE + 'akses/get',
            data: "id=" + id,
            dataType: 'json',
            config: {headers: {'Content-Type': 'multipart/form-data'}}
        }).then(function (res) {
            if (res.data.status == 200) {
                this.setState({
                    id: res.data.list.id,
                    id_user_level: res.data.id_user_level,
                    id_menu: res.data.list.id_menu,
                    create: res.data.list.create,
                    read: res.data.list.read,
                    update: res.data.list.update,
                    delete: res.data.list.delete,
                    edit: true
                });

                let isCreate = res.data.list.create === 1 ? true : false;
                let isRead = res.data.list.read === 1 ? true : false;
                let isUpdate = res.data.list.update === 1 ? true : false;
                let isDelete = res.data.list.delete === 1 ? true : false;

                self.$cr.prop('checked', isCreate);
                self.$rd.prop('checked', isRead);
                self.$up.prop('checked', isUpdate);
                self.$dl.prop('checked', isDelete);
            } else {
                console.log(res.data.msg);
            }
        }.bind(this)).catch(function (res) {
            console.log(res);
        })
    }

    handleChange(e) {
        let checked = (e.target.checked === false) ? 0 : 1;
        this.setState({[e.target.name]: checked});
    }

    handleSubmit(e) {
        e.preventDefault();
        let role = this.state.id_user_level,
            menu = this.state.id_menu,
            create = this.state.create,
            read = this.state.read,
            update = this.state.update,
            destroy = this.state.delete,
            sendData = "id_user_level=" + role +
                "&id_menu= " + menu +
                "&create= " + create +
                "&read= " + read +
                "&update= " + update +
                "&delete= " + destroy;

        if (this.state.edit === false) {
            axios({
                method: 'post',
                url: ROUTE + 'akses/insert',
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
                url: ROUTE + 'akses/update',
                data: "create=" + create + "&read=" + read + '&update=' + update + '&delete=' + destroy + '&id=' + id,
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
                            url: ROUTE + 'akses/delete',
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

    componentDidMount() {
        this.reloadLevel();
        this.reloadMenu();

        this.$r = $(this.r);
        this.$r.select2({
            width: '100%'
        });
        this.$r.on('change', this.inputChange);

        this.$m = $(this.m);
        this.$m.select2({
            width: '100%'
        });
        this.$m.on('change', this.inputChange);

        var styles = {
            create: function (row, type, data) {
                var icon;
               if (data.create == 1) {
                    icon = '<i class="icon icon-check"></i>';
               } else {
                   icon = '<i class="icon icon-close"></i>';
               }
               return icon;
            },

            read: function (row, type, data) {
                var icon;
                if (data.read == 1) {
                    icon = '<i class="icon icon-check"></i>';
                } else {
                    icon = '<i class="icon icon-close"></i>';
                }
                return icon;
            },

            update: function (row, type, data) {
                var icon;
                if (data.update == 1) {
                    icon = '<i class="icon icon-check"></i>';
                } else {
                    icon = '<i class="icon icon-close"></i>';
                }
                return icon;
            },

            delete: function (row, type, data) {
                var icon;
                if (data.delete == 1) {
                    icon = '<i class="icon icon-check"></i>';
                } else {
                    icon = '<i class="icon icon-close"></i>';
                }
                return icon;
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
                "url": ROUTE + 'akses/json',
                "type": "POST",
                "headers": {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                },
            },

            columns: [
                {data: 'DT_RowIndex'},
                {data: 'role.nama'},
                {data: 'menu.title'},
                {data: 'create', orderable: false, render: styles.create},
                {data: 'read', orderable: false, render: styles.read},
                {data: 'update', orderable: false, render: styles.update},
                {data: 'delete', orderable: false, render: styles.delete},
            ],

            columnDefs: [
                {
                    targets: 7,
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
                                    <strong>Daftar User Navigation</strong>
                                </div>
                                <div className="card-body">
                                    <div className="table-responsive">
                                        <table id="demo-datatables"
                                               className="table table-striped table-hover table-nowrap dataTable"
                                               width="100%" ref={el => this.el = el}>
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Role</th>
                                                <th>Menu</th>
                                                <th>Create</th>
                                                <th>View</th>
                                                <th>Update</th>
                                                <th>Delete</th>
                                                <th width="100px">Aksi</th>
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
                                <h4 className="modal-title-insert" ref={tl => this.tl = tl}>Tambah Data User Navigation</h4>
                            </div>
                            <form className="form" method="post">
                                <div className="modal-body">
                                    <div className="form-group" ref={rl => this.rl = rl}>
                                        <label htmlFor="id_user_level" className="form-label">Role</label>
                                        <select id="id_user_level" ref={r => this.r = r} name="id_user_level" onChange={this.inputChange} value={this.state.id_user_level} className="form-control">
                                            <option value="">-- Pilih Role --</option>
                                            {this.state.cmb_role.map((data, index) => {
                                                return (
                                                    <option key={index} value={data.id}>{data.nama}</option>
                                                )
                                            })}
                                        </select>
                                        <span className="text-danger">
                                            <strong id="id_user_level-error"></strong>
                                        </span>
                                    </div>
                                    <div className="form-group" ref={mn => this.mn = mn}>
                                        <label htmlFor="id_menu" className="form-label">Menu</label>
                                        <select id="id_menu" ref={m => this.m = m} name="id_menu" onChange={this.inputChange} value={this.state.id_menu} className="form-control">
                                            <option value="">-- Pilih Menu --</option>
                                            {this.state.cmb_menu.map((data, index) => {
                                                return (
                                                    <option key={index} value={data.id}>{data.title}</option>
                                                )
                                            })}
                                        </select>
                                        <span className="text-danger">
                                            <strong id="id_menu-error"></strong>
                                        </span>
                                    </div>
                                    <div className="form-group">
                                        <label className="form-label">Hak Akses</label><br/>
                                        <label className="custom-control custom-control-primary custom-checkbox">
                                            <input className="custom-control-input" ref={cr => this.cr = cr} onChange={this.handleChange} value={this.state.create} name="create" id="create" type="checkbox"/>
                                                <span className="custom-control-indicator" style={{marginTop: '-2px'}}></span>
                                        </label>
                                        <label htmlFor="create" style={{marginLeft: '5px'}}>Create</label>
                                        <label className="custom-control custom-control-primary custom-checkbox" style={{marginLeft: '10px'}}>
                                            <input className="custom-control-input" ref={rd => this.rd = rd} onChange={this.handleChange} value={this.state.read} name="read" id="read" type="checkbox"/>
                                            <span className="custom-control-indicator" style={{marginTop: '-2px'}}></span>
                                        </label>
                                        <label htmlFor="read" style={{marginLeft: '5px'}}>Read</label>
                                        <label className="custom-control custom-control-primary custom-checkbox" style={{marginLeft: '10px'}}>
                                            <input className="custom-control-input" ref={up => this.up = up} onChange={this.handleChange} value={this.state.update} name="update" id="update" type="checkbox"/>
                                            <span className="custom-control-indicator" style={{marginTop: '-2px'}}></span>
                                        </label>
                                        <label htmlFor="update" style={{marginLeft: '5px'}}>Update</label>
                                        <label className="custom-control custom-control-primary custom-checkbox" style={{marginLeft: '10px'}}>
                                            <input className="custom-control-input" ref={dl => this.dl = dl} onChange={this.handleChange} value={this.state.delete} name="delete" id="delete" type="checkbox"/>
                                            <span className="custom-control-indicator" style={{marginTop: '-2px'}}></span>
                                        </label>
                                        <label htmlFor="delete" style={{marginLeft: '5px'}}>Delete</label>
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

if (document.getElementById('user_navigation')) {
    ReactDOM.render(<UserNavigation/>, document.getElementById('user_navigation'));
}
