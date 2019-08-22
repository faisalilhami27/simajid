import React, {Component, Fragment} from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import {ROUTE} from "./Route";
import '../../../public/js/dataTables.bootstrap4.min';
import '../../../public/js/jquery-confirm';
import '../../../public/js/script';
import '../../../public/js/select2.min';

const $ = require('jquery');
$.Datatable = require('datatables.net');

export default class StrukturOrganisasiDKM extends Component {
    constructor(props) {
        super(props);
        this.state = {
            id: 0,
            id_jabatan: '',
            id_pengurus: '',
            cmb_pengurus: [],
            cmb_jabatan: [],
            access: JSON.parse(this.props.data),
            edit: false
        };

        this.openModal = this.openModal.bind(this);
        this.inputChange = this.inputChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
        this.reloadJabatan = this.reloadJabatan.bind(this);
        this.reloadPengurus = this.reloadPengurus.bind(this);
    }

    inputChange(e) {
        this.setState({[e.target.name]: e.target.value});
    }

    reloadPengurus() {
        axios({
            method: 'get',
            url: ROUTE + 'struktur/getPengurus',
            dataType: 'json'
        }).then(res => {
            this.setState({
                cmb_pengurus: res.data
            })
        })
    }

    reloadJabatan() {
        axios({
            method: 'get',
            url: ROUTE + 'struktur/getJabatan',
            dataType: 'json'
        }).then(res => {
            this.setState({
                cmb_jabatan: res.data
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
                            url: ROUTE + 'struktur/dkm/delete',
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
        let idJenisPengurus = this.state.id_jabatan,
            idPengurus = this.state.id_pengurus,
            sendData = "id_jabatan=" + idJenisPengurus + "&id_pengurus=" + idPengurus;

        if (this.state.edit === false) {
            axios({
                method: 'post',
                url: ROUTE + 'struktur/dkm/insert',
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
                url: ROUTE + 'struktur/dkm/update',
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

    handleEdit(id) {
        const self = this;
        this.$tl = $(this.tl);
        axios({
            method: 'post',
            url: ROUTE + 'struktur/dkm/get',
            data: "id=" + id,
            dataType: 'json',
            config: {headers: {'Content-Type': 'multipart/form-data'}}
        }).then(function (res) {
            if (res.data.status == 200) {
                this.setState({
                    id: res.data.list.id,
                    id_jabatan: res.data.list.id_jabatan,
                    id_pengurus: res.data.list.id_pengurus,
                    edit: true
                });
                self.$tl.html("Update Data Struktur Organisasi DKM");
            } else {
                console.log(res.data.msg);
            }
        }.bind(this)).catch(function (res) {
            console.log(res);
        })
    }

    openModal() {
        this.setState({
            edit: false
        });

        this.$tl = $(this.tl);
        this.$tl.html("Tambah Data Struktur Organisasi DKM");
    }

    componentDidMount() {
        this.reloadJabatan();
        this.reloadPengurus();
        this.$el = $(this.el);
        this.$sl = $(this.sl);
        this.$jb = $(this.jb);
        this.$sl.select2({
            width: '100%'
        });
        this.$sl.on('change', this.inputChange);
        this.$jb.select2({
            width: '100%'
        });
        this.$jb.on('change', this.inputChange);
        this.$el.DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            aLengthMenu: [[5, 10, 25, 100], [5, 10, 25, 100]],
            order: [],

            ajax: {
                "url": ROUTE + 'struktur/dkm/json',
                "type": "POST",
                "headers": {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                },
            },

            columns: [
                {data: 'DT_RowIndex'},
                {data: 'jabatan.nama'},
                {data: 'pengurus.nama'}
            ],

            columnDefs: [
                {
                    targets: 3,
                    data: null,
                    createdCell: (td, cellData, rowData, row, col) => {
                        if (this.state.access.update_delete) {
                            ReactDOM.render(
                                <div>
                                    <center>
                                        <button data-toggle="modal" data-target="#infoModalColoredHeader" className="btn btn-success btn-sm btn-edit" id={rowData.id} onClick={() => this.handleEdit(rowData.id)}><i className="icon icon-pencil-square-o"></i></button> <button className="btn btn-danger btn-sm" id={rowData.id} onClick={() => this.handleDelete(rowData.id)}><i className="icon icon-trash"></i></button>
                                    </center>
                                </div>, td
                            )
                        } else if (this.state.access.update) {
                            ReactDOM.render(
                                <div>
                                    <center>
                                        <button data-toggle="modal" data-target="#infoModalColoredHeader" className="btn btn-success btn-sm btn-edit" id={rowData.id} onClick={() => this.handleEdit(rowData.id)}><i className="icon icon-pencil-square-o"></i></button>
                                    </center>
                                </div>, td
                            )
                        } else {
                            ReactDOM.render(
                                <div>
                                    <center>Tidak ada akses</center>
                                </div>, td
                            )
                        }
                    }
                }
            ]
        });
    }

    render() {
        let button;
        if (this.state.access.create) {
            button = <button className="btn btn-info btn-sm" type="button" data-toggle="modal"
                             data-target="#infoModalColoredHeader" onClick={this.openModal}
                             style={{marginBottom: '10px'}}><i className="icon icon-plus-circle"></i> Tambah
            </button>
        }
        return (
            <Fragment>
                <div className="layout-content-body">
                    {button}
                    <div className="row gutter-xs">
                        <div className="col-xs-12">
                            <div className="card">
                                <div className="card-header">
                                    <strong>Daftar Struktur Organisasi DKM</strong>
                                </div>
                                <div className="card-body">
                                    <div className="table-responsive">
                                        <table id="demo-datatables"
                                               className="table table-striped table-hover table-nowrap dataTable"
                                               width="100%" ref={el => this.el = el}>
                                            <thead>
                                            <tr>
                                                <th width="20px">No</th>
                                                <th>Jabatan</th>
                                                <th>Nama Pengurus</th>
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
                                <h4 className="modal-title-insert" ref={tl => this.tl = tl}>Tambah Data Role Level</h4>
                            </div>
                            <form className="form" method="post">
                                <div className="modal-body">
                                    <div className="form-group">
                                        <label htmlFor="id_pengurus" className="form-label">Pengurus</label>
                                        <select id="id_pengurus" ref={sl => this.sl = sl} onChange={this.inputChange} value={this.state.id_pengurus} name="id_pengurus" className="form-control">
                                            <option value="">-- Pilih Pengurus --</option>
                                            {this.state.cmb_pengurus.map((data, index) => {
                                                return (
                                                    <option key={index} value={data.id}>{data.nama}</option>
                                                )
                                            })}
                                        </select>
                                        <span className="text-danger">
                                            <strong id="id_pengurus-error"></strong>
                                        </span>
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="id_jabatan" className="form-label">Jabatan</label>
                                        <select id="id_jabatan" ref={jb => this.jb = jb} onChange={this.inputChange} value={this.state.id_jabatan} name="id_jabatan" className="form-control">
                                            <option value="">-- Pilih Jabatan --</option>
                                            {this.state.cmb_jabatan.map((data, index) => {
                                                return (
                                                    <option key={index} value={data.id}>{data.nama}</option>
                                                )
                                            })}
                                        </select>
                                        <span className="text-danger">
                                            <strong id="id_jabatan-error"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div className="modal-footer">
                                    <button className="btn btn-default" data-dismiss="modal" type="button">Cancel
                                    </button>
                                    <button className="btn btn-primary" id="btn-insert-data" onClick={this.handleSubmit} type="submit">Submit
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

if (document.getElementById('struktur')) {
    let data = document.getElementById('struktur').getAttribute('data');
    ReactDOM.render(<StrukturOrganisasiDKM data={data}/>, document.getElementById('struktur'));
}
