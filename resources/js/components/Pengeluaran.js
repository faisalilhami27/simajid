import React, {Component, Fragment} from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import {ROUTE} from "./Route";
import script from './MyScript';

const $ = require('jquery');
$.Datatable = require('datatables.net');

export default class Pengeluaran extends Component {
    constructor(props) {
        super(props);
        this.state = {
            id: 0,
            tanggal: '',
            id_jenis: '',
            jumlah: '',
            keterangan: '',
            cmb_jenis: [],
            edit: false,
            checkAccess: JSON.parse(this.props.data)
        };

        this.openModal = this.openModal.bind(this);
        this.inputChange = this.inputChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
        this.reloadJenisPengeluaran = this.reloadJenisPengeluaran.bind(this);
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
                            url: ROUTE + 'pengeluaran/delete',
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

    reloadJenisPengeluaran() {
        axios({
            method: 'post',
            url: ROUTE + 'pengeluaran/jenis',
            dataType: 'json'
        }).then(res => {
            this.setState({
                cmb_jenis: res.data
            })
        })
    }

     handleSubmit(e) {
        e.preventDefault();
        let tanggal = this.state.tanggal,
            jenis = this.state.id_jenis,
            jumlah = this.state.jumlah,
            keterangan = this.state.keterangan,
            sendData = "tanggal=" + tanggal +
                "&id_jenis=" + jenis +
                "&jumlah=" + jumlah +
                "&id_jenis=" + jenis +
                "&keterangan=" + keterangan;

        if (this.state.edit === false) {
            axios({
                method: 'post',
                url: ROUTE + 'pengeluaran/insert',
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
                url: ROUTE + 'pengeluaran/update',
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
        this.$tl = $(this.tl);
        this.$tl.html("Update Data Pengeluaran Keuangan");
        axios({
            method: 'post',
            url: ROUTE + 'pengeluaran/get',
            data: "id=" + id,
            dataType: 'json',
            config: {headers: {'Content-Type': 'multipart/form-data'}}
        }).then(function (res) {
            if (res.data.status == 200) {
                this.setState({
                    id: res.data.list.id,
                    tanggal: res.data.list.tanggal,
                    id_jenis: res.data.list.id_jenis,
                    jumlah: res.data.list.jumlah,
                    keterangan: res.data.list.keterangan,
                    edit: true
                });
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
        this.$tl.html("Tambah Data Pengeluaran Keuangan");
    }

    componentDidMount() {
        this.reloadJenisPengeluaran();
        this.$jm = $(this.jm);
        this.$el = $(this.el);
        this.$tg = $(this.tg);

        let cleave = new Cleave(this.$jm, {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });
        this.$jm.on('change', this.inputChange);
        this.$tg.datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
        this.$tg.on('change', this.inputChange);

        let styles = {
          format: function (row, type, data) {
              return formatRupiah(data.jumlah, 'Rp. ');
          }
        };

        this.$el.DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            aLengthMenu: [[5, 10, 25, 100], [5, 10, 25, 100]],
            order: [],

            ajax: {
                "url": ROUTE + 'pengeluaran/json',
                "type": "POST",
                "headers": {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                },
            },

            columns: [
                {data: 'DT_RowIndex'},
                {data: 'tanggal'},
                {data: 'jumlah', render: styles.format},
                {data: 'jenis.nama'},
                {data: 'keterangan'}
            ],

            columnDefs: [
                {
                    targets: 5,
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
        if (this.state.checkAccess != null) {
            if (this.state.checkAccess.create) {
                button = <button className="btn btn-info btn-sm" type="button" data-toggle="modal"
                                 data-target="#infoModalColoredHeader" onClick={this.openModal}
                                 style={{marginBottom: '10px'}}><i className="icon icon-plus-circle"></i> Tambah
                </button>
            }
        }

        return (
            <Fragment>
                <div className="layout-content-body">
                    {button}
                    <div className="row gutter-xs">
                        <div className="col-xs-12">
                            <div className="card">
                                <div className="card-header">
                                    <strong>Daftar Pengeluaran Keuangan</strong>
                                </div>
                                <div className="card-body">
                                    <div className="table-responsive">
                                        <table id="demo-datatables"
                                               className="table table-striped table-hover table-nowrap dataTable"
                                               width="100%" ref={el => this.el = el}>
                                            <thead>
                                            <tr>
                                                <th width="20px">No</th>
                                                <th>Tanggal</th>
                                                <th>Jumlah</th>
                                                <th>Jenis Pengeluaran</th>
                                                <th>Keterangan</th>
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
                                <h4 className="modal-title-insert" ref={tl => this.tl = tl}>Tambah</h4>
                            </div>
                            <form className="form" method="post">
                                <div className="modal-body">
                                    <div className="form-group">
                                        <label htmlFor="tanggal">Tanggal</label>
                                        <div className="input-with-icon">
                                            <input className="form-control" type="text"
                                                   name="tanggal"
                                                   id="tanggal"
                                                   placeholder="Masukan Tanggal"
                                                   value={this.state.tanggal}
                                                   onChange={this.inputChange}
                                                   ref={tg => this.tg = tg}
                                                   data-date-today-highlight="true"/>
                                            <span className="icon icon-calendar input-icon"></span>
                                        </div>
                                        <span className="text-danger">
                                            <strong id="tanggal-error"></strong>
                                        </span>
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="id_jenis">Jenis Pengeluaran</label>
                                        <select name="id_jenis" id="id_jenis" className="form-control" ref={jn => this.jn = jn} onChange={this.inputChange} value={this.state.id_jenis}>
                                            <option value="">-- Pilih Jenis Pengeluaran --</option>
                                            {this.state.cmb_jenis.map((data, index) => {
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
                                        <label htmlFor="jumlah">Jumlah</label>
                                        <input id="jumlah" name="jumlah" className="form-control" type="text"
                                               placeholder="Masukan jumlah" maxLength="15"
                                               onChange={this.inputChange}
                                               value={this.state.jumlah}
                                               ref={jm => this.jm = jm}
                                               autoComplete="off"/>
                                        <span className="text-danger">
                                            <strong id="jumlah-error"></strong>
                                        </span>
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="keterangan">Keterangan</label>
                                        <textarea maxLength="500" id="keterangan" placeholder="Masukan Keterangan" name="keterangan" value={this.state.keterangan} onChange={this.inputChange} className="form-control" rows="3"></textarea>
                                        <span className="text-danger">
                                            <strong id="keterangan-error"></strong>
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

if (document.getElementById('pengeluaran')) {
    var data = document.getElementById('pengeluaran').getAttribute('data');
    ReactDOM.render(<Pengeluaran data={data}/>, document.getElementById('pengeluaran'));
}
