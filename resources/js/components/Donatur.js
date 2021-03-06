import React, {Component, Fragment} from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import {ROUTE} from "./Route";
import '../../../public/js/dataTables.bootstrap4.min';
import '../../../public/js/jquery-confirm';
import '../../../public/js/script';
import '../../../public/js/datepicker.min';

const $ = require('jquery');
$.Datatable = require('datatables.net');

export default class Donatur extends Component {
    constructor(props) {
        super(props);
        this.state = {
            id: 0,
            nama: '',
            id_jenis: '',
            tempat_lahir: '',
            tanggal_lahir: '',
            alamat: '',
            no_hp: '',
            jenis_kelamin: '',
            pria: 1,
            wanita: 0,
            cmb_donatur: [],
            edit: false,
            checkAccess: JSON.parse(this.props.data)
        };

        this.openModal = this.openModal.bind(this);
        this.inputChange = this.inputChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
        this.reloadJenisDonatur = this.reloadJenisDonatur.bind(this);
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
                            url: ROUTE + 'donatur/delete',
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

    reloadJenisDonatur() {
        axios({
            method: 'get',
            url: ROUTE + 'donatur/jenis',
            dataType: 'json'
        }).then(res => {
            this.setState({
                cmb_donatur: res.data
            })
        })
    }

    handleSubmit(e) {
        e.preventDefault();
        let nama = this.state.nama,
            tempatLahir = this.state.tempat_lahir,
            tanggalLahir = this.state.tanggal_lahir,
            noHp = this.state.no_hp,
            alamat = this.state.alamat,
            jenisKelamin = this.state.jenis_kelamin,
            jenis = this.state.id_jenis,
            sendData = "nama=" + nama +
                "&id_jenis=" + jenis +
                "&tempat_lahir=" + tempatLahir +
                "&tanggal_lahir=" + tanggalLahir +
                "&no_hp=" + noHp +
                "&alamat=" + alamat +
                "&jenis_kelamin=" + jenisKelamin;

        if (this.state.edit === false) {
            axios({
                method: 'post',
                url: ROUTE + 'donatur/insert',
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
                url: ROUTE + 'donatur/update',
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
            url: ROUTE + 'donatur/get',
            data: "id=" + id,
            dataType: 'json',
            config: {headers: {'Content-Type': 'multipart/form-data'}}
        }).then(function (res) {
            if (res.data.status == 200) {
                this.setState({
                    id: res.data.list.id,
                    nama: res.data.list.nama,
                    id_jenis: res.data.list.id_jenis,
                    tempat_lahir: res.data.list.tempat_lahir,
                    tanggal_lahir: res.data.list.tanggal_lahir,
                    alamat: res.data.list.alamat,
                    no_hp: res.data.list.no_hp,
                    jenis_kelamin: res.data.list.jenis_kelamin,
                    edit: true
                });
                self.$tl.html("Update Data Donatur");
                $('input:radio[name=jenis_kelamin][value='+res.data.list.jenis_kelamin+']')[0].checked = true;
            } else {
                console.log(res.data.msg);
            }
        }.bind(this)).catch(function (res) {
            console.log(res);
        })
    }

    openModal() {
        this.setState({
            id: 0,
            nama: '',
            edit: false
        });

        this.$tl = $(this.tl);
        this.$tl.html("Tambah Data Donatur");
    }

    componentDidMount() {
        this.reloadJenisDonatur();
        this.$el = $(this.el);
        this.$tg = $(this.tg);
        this.$tg.datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
        this.$tg.on('change', this.inputChange);
        this.$el.DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            aLengthMenu: [[5, 10, 25, 100], [5, 10, 25, 100]],
            order: [],

            ajax: {
                "url": ROUTE + 'donatur/json',
                "type": "POST",
                "headers": {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                },
            },

            columns: [
                {data: 'DT_RowIndex'},
                {data: 'nama'},
                {data: 'jenis.nama'}
            ],

            columnDefs: [
                {
                    targets: 3,
                    data: null,
                    createdCell: (td, cellData, rowData, row, col) => {
                        if (this.state.checkAccess.update_delete) {
                            ReactDOM.render(
                                <div>
                                    <center>
                                        <button data-toggle="modal" data-target="#infoModalColoredHeader" className="btn btn-success btn-sm btn-edit" id={rowData.id} onClick={() => this.handleEdit(rowData.id)}><i className="icon icon-pencil-square-o"></i></button> <button className="btn btn-danger btn-sm" id={rowData.id} onClick={() => this.handleDelete(rowData.id)}><i className="icon icon-trash"></i></button>
                                    </center>
                                </div>, td
                            )
                        } else if (this.state.checkAccess.update) {
                            ReactDOM.render(
                                <div>
                                    <center>
                                        <button data-toggle="modal" data-target="#infoModalColoredHeader" className="btn btn-success btn-sm btn-edit" id={rowData.id} onClick={() => this.handleEdit(rowData.id)}><i className="icon icon-pencil-square-o"></i></button>
                                    </center>
                                </div>, td
                            )
                        } else {
                            ReactDOM.render(
                                <div>Tidak ada aksi</div>, td
                            )
                        }
                    }
                }
            ]
        });
    }

    render() {
        let button;
        if (this.state.checkAccess.create) {
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
                                    <strong>Daftar Donatur</strong>
                                </div>
                                <div className="card-body">
                                    <div className="table-responsive">
                                        <table id="demo-datatables"
                                               className="table table-striped table-hover table-nowrap dataTable"
                                               width="100%" ref={el => this.el = el}>
                                            <thead>
                                            <tr>
                                                <th width="20px">No</th>
                                                <th>Nama Donatur</th>
                                                <th>Jenis Donatur</th>
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
                                    <span aria-hidden="true">??</span>
                                    <span className="sr-only">Close</span>
                                </button>
                                <h4 className="modal-title-insert" ref={tl => this.tl = tl}>Tambah Data Role Level</h4>
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
                                        <label htmlFor="id_jenis">Jenis Donatur</label>
                                        <select name="id_jenis" id="id_jenis" className="form-control" onChange={this.inputChange} value={this.state.id_jenis}>
                                            <option value="">-- Pilih Jenis Donatur --</option>
                                            {this.state.cmb_donatur.map((data, index) => {
                                                return (
                                                    <option key={index} value={data.id}>{data.nama}</option>
                                                )
                                            })}
                                        </select>
                                        <span className="text-danger">
                                            <strong id="id_jenis-error"></strong>
                                        </span>
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="tempat_lahir">Tempat Lahir</label>
                                        <input id="tempat_lahir" name="tempat_lahir" className="form-control" type="text"
                                               placeholder="Masukan Tempat Lahir" maxLength="60"
                                               onChange={this.inputChange}
                                               value={this.state.tempat_lahir}
                                               autoComplete="off"/>
                                        <span className="text-danger">
                                            <strong id="tempat_lahir-error"></strong>
                                        </span>
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="no_hp">Nomor Handphone</label>
                                        <input id="no_hp" name="no_hp" className="form-control" type="text"
                                               placeholder="Masukan Nomor Handphone" maxLength="15"
                                               onChange={this.inputChange}
                                               value={this.state.no_hp}
                                               autoComplete="off"/>
                                        <span className="text-danger">
                                            <strong id="no_hp-error"></strong>
                                        </span>
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="tanggal_lahir">Tanggal Lahir</label>
                                        <div className="input-with-icon">
                                            <input className="form-control" type="text"
                                                   name="tanggal_lahir"
                                                   id="tanggal_lahir"
                                                   placeholder="Masukan Tanggal Lahir"
                                                   value={this.state.tanggal_lahir}
                                                   onChange={this.inputChange}
                                                   ref={tg => this.tg = tg}
                                                   data-date-today-highlight="true"/>
                                                <span className="icon icon-calendar input-icon"></span>
                                        </div>
                                        <span className="text-danger">
                                            <strong id="tanggal_lahir-error"></strong>
                                        </span>
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="jenis_kelamin">Jenis Kelamin</label><br/>
                                        <label className="custom-control custom-control-primary custom-radio custom-control-inline">
                                            <input className="custom-control-input" id="jenis_kelamin" value={this.state.pria}
                                                   onChange={this.inputChange} type="radio" name="jenis_kelamin"/>
                                            <span className="custom-control-indicator"></span>
                                            <span className="custom-control-label">Laki-laki</span>
                                        </label>
                                        <label className="custom-control custom-control-primary custom-radio custom-control-inline">
                                            <input className="custom-control-input" id="jenis_kelamin" value={this.state.wanita}
                                                   onChange={this.inputChange} type="radio" name="jenis_kelamin"/>
                                            <span className="custom-control-indicator"></span>
                                            <span className="custom-control-label">Perempuan</span>
                                        </label>
                                        <span className="text-danger">
                                            <strong id="jenis_kelamin-error"></strong>
                                        </span>
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="alamat">Alamat</label>
                                        <textarea maxLength="500" id="alamat" placeholder="Masukan Alamat" name="alamat" value={this.state.alamat} onChange={this.inputChange} className="form-control" rows="3"></textarea>
                                        <span className="text-danger">
                                            <strong id="alamat-error"></strong>
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

if (document.getElementById('donatur')) {
    var data = document.getElementById('donatur').getAttribute('data');
    ReactDOM.render(<Donatur data={data}/>, document.getElementById('donatur'));
}
