import React, {Component, Fragment} from 'react';
import ReactDOM from 'react-dom';
import {ROUTE} from "./Route";
import '../../../public/js/dataTables.bootstrap4.min';
import '../../../public/js/select2.min';
import '../../css/style.css';
import '../../../public/js/jquery-confirm';
import '../../../public/js/script';

const $ = require('jquery');
$.Datatable = require('datatables.net');

export default class Navigation extends Component {
    constructor(props) {
        super(props);
        this.state = {
            id: 0,
            title: '',
            url: '',
            icon: '',
            noUrut: '',
            noSubMenu: '',
            mainMenu: '',
            status: '',
            navigation: [],
            edit: false
        };

        this.openModal = this.openModal.bind(this);
        this.inputChange = this.inputChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    reloadNavigation() {
        axios({
            method: 'GET',
            url: ROUTE + 'navigation/getNavigation',
            dataType: 'JSON'
        })
            .then(res => {
                this.setState({
                    navigation: res.data
                })
            })
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
                            url: ROUTE + 'navigation/delete',
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
        let title = this.state.title,
            url = this.state.url,
            icon = this.state.icon,
            noUrut = this.state.noUrut,
            noSubMenu = this.state.noSubMenu,
            mainMenu = this.state.mainMenu,
            status = this.state.status,
            sendData = "title=" + title + "&url=" + url + "&nomor=" + noUrut + "&sub=" + noSubMenu + "&icon=" + icon + "&is_main_menu=" + mainMenu + "&is_aktif=" + status;

        if (this.state.edit === false) {
            axios({
                method: 'post',
                url: ROUTE + 'navigation/insert',
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
                url: ROUTE + 'navigation/update',
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

    openModal() {
       this.setState({
           id: 0,
           title: '',
           url: '',
           icon: '',
           noUrut: '',
           noSubMenu: '',
           mainMenu: '',
           status: '',
       });

        this.$tl = $(this.tl);
        this.$tl.html("Tambah Data Navigation");
    }

    componentDidMount() {
        const self = this;
        this.reloadNavigation();
        this.$sl = $(this.sl);
        this.$sb = $(this.sb);
        this.$sl.select2({
            width: '100%'
        });
        this.$sl.on('change', this.inputChange);

        this.$sl.on('change', function (e) {
            let menu = e.target.value;
            if (menu == 0 || menu == '') {
                self.$sb.slideUp(1000);
            } else {
                self.$sb.slideDown(1000);
            }
        });

        var styles = {
            status: function (row, type, data) {
                if (data.is_aktif == "y") {
                    return "<center>" + "<span class='label label-primary'>Aktif</span>" + "</center>";
                } else {
                    return "<center>" + "<span class='label label-danger'>Tidak aktif</span>" + "</center>";
                }
            },

            icon: function (row, type, data) {
                return `<span class="${data.icon}"></span>`;
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
                "url": ROUTE + 'navigation/json',
                "type": "POST",
                "headers": {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                },
            },

            columns: [
                {data: 'DT_RowIndex'},
                {data: 'title'},
                {data: 'url'},
                {data: 'icon', render: styles.icon},
                {data: 'order_num'},
                {data: 'is_main_menu'},
                {data: 'is_aktif', render: styles.status},
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

    handleEdit(id) {
        const self = this;
        this.$tl = $(this.tl);
        axios({
            method: 'post',
            url: ROUTE + 'navigation/get',
            data: "id=" + id,
            dataType: 'json',
            config: {headers: {'Content-Type': 'multipart/form-data'}}
        }).then(function (res) {
            if (res.data.status == 200) {
                this.setState({
                    id: res.data.list.id,
                    title: res.data.list.title,
                    url: res.data.list.url,
                    icon: res.data.list.icon,
                    noUrut: res.data.list.order_num,
                    noSubMenu: res.data.list.order_sub,
                    mainMenu: res.data.list.is_main_menu,
                    status: res.data.list.is_aktif,
                    edit: true
                });
                this.$tl.html("Update Data Navigation");
                this.$sl.select2().val(res.data.list.is_main_menu).trigger('change');
            } else {
                console.log(res.data.msg);
            }
        }.bind(this)).catch(function (res) {
            console.log(res);
        })
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
                                    <strong>Daftar Navigation</strong>
                                </div>
                                <div className="card-body">
                                    <div className="table-responsive">
                                        <table id="demo-datatables"
                                               className="table table-striped table-hover table-nowrap dataTable"
                                               width="100%" ref={el => this.el = el}>
                                            <thead>
                                            <tr>
                                                <th width="20px">No</th>
                                                <th>Title</th>
                                                <th>URL</th>
                                                <th>Icon</th>
                                                <th>Nomor Urut</th>
                                                <th>Main Menu</th>
                                                <th>Status</th>
                                                <th width="150px">Aksi</th>
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
                <div id="infoModalColoredHeader" role="dialog" className="modal fade" aria-labelledby="infoModalColoredHeaderLabel" aria-hidden="true">
                    <div className="modal-dialog">
                        <div className="modal-content">
                            <div className="modal-header bg-primary">
                                <button type="button" className="close" data-dismiss="modal">
                                    <span aria-hidden="true">×</span>
                                    <span className="sr-only">Close</span>
                                </button>
                                <h4 className="modal-title-insert" ref={tl => this.tl = tl}>Tambah Data Navigation</h4>
                            </div>
                            <form className="form" method="post">
                                <div className="modal-body">
                                    <div className="form-group">
                                        <label htmlFor="title">Title</label>
                                        <input id="title" onChange={this.inputChange} value={this.state.title} name="title" className="form-control" type="text"
                                               placeholder="Masukan title menu" maxLength="30" autoComplete="off"/>
                                        <span className="text-danger">
                                            <strong id="title-error"></strong>
                                        </span>
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="url">Url</label>
                                        <input id="url" onChange={this.inputChange} value={this.state.url} name="url" className="form-control" type="text"
                                               placeholder="Masukan url menu" maxLength="30" autoComplete="off"/>
                                        <span className="text-danger">
                                            <strong id="url-error"></strong>
                                        </span>
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="icon">Icon</label>
                                        <input id="icon" onChange={this.inputChange} value={this.state.icon} name="icon" className="form-control" type="text"
                                               placeholder="Masukan icon menu contoh : icon icon-user" maxLength="30"
                                               autoComplete="off"/>
                                        <span className="text-danger">
                                    <strong id="icon-error"></strong>
                                </span>
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="noUrut">Nomor Urut</label>
                                        <input id="noUrut" onChange={this.inputChange} value={this.state.noUrut} name="noUrut" className="form-control" type="text"
                                               placeholder="Masukan nomor urut menu contoh : 1" maxLength="4"
                                               autoComplete="off"/>
                                        <span className="text-danger">
                                            <strong id="nomor-error"></strong>
                                        </span>
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="mainMenu" className="form-label">Main Menu</label>
                                        <select id="mainMenu" ref={sl => this.sl = sl} onChange={this.inputChange} value={this.state.mainMenu} name="mainMenu" className="form-control">
                                            <option value="">-- Pilih Main Menu --</option>
                                            <option value="0">Main Menu</option>
                                            {this.state.navigation.map((data, index) => {
                                                return (
                                                    <option key={index} value={data.id}>{data.title}</option>
                                                )
                                            })}
                                        </select>
                                        <span className="text-danger">
                                            <strong id="is_main_menu-error"></strong>
                                        </span>
                                    </div>
                                    <div ref={sb => this.sb = sb} className="form-group nomor_sub_menu" style={{display: 'none'}}>
                                        <label htmlFor="noSubMenu">Nomor Urut Sub Menu</label>
                                        <input id="noSubMenu" onChange={this.inputChange} value={this.state.noSubMenu} name="noSubMenu" className="form-control"
                                               type="text"
                                               placeholder="Masukan nomor urut sub menu contoh : 1" maxLength="4"
                                               autoComplete="off"/>
                                        <span className="text-danger">
                                            <strong id="sub-error"></strong>
                                        </span>
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="status" className="form-label">Status</label>
                                        <select id="status" onChange={this.inputChange} name="status" value={this.state.status} className="form-control">
                                            <option value="">-- Pilih Status --</option>
                                            <option value="y">Aktif</option>
                                            <option value="n">Tidak</option>
                                        </select>
                                    </div>
                                    <span className="text-danger">
                                        <strong id="is_aktif-error"></strong>
                                    </span>
                                </div>
                                <div className="modal-footer">
                                    <button className="btn btn-default" data-dismiss="modal" type="button">Cancel
                                    </button>
                                    <button className="btn btn-primary" id="btn-insert-data" type="submit" onClick={this.handleSubmit}>Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </Fragment>
        );
    }
}

if (document.getElementById('navigation')) {
    ReactDOM.render(<Navigation/>, document.getElementById('navigation'));
}
