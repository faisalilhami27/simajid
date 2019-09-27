import React, {Component, Fragment} from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import {ROUTE} from "./Route";

const $ = require('jquery');
$.Datatable = require('datatables.net');

export default class Jadwal extends Component {
    constructor(props) {
        super(props);
        this.state = {
            jadwal: []
        };

        this.getCurrentLocation = this.getCurrentLocation.bind(this);
    }

    getCurrentLocation() {
        const self = this;
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                let latitude = position.coords.latitude,
                    longitude = position.coords.longitude;
                axios({
                    method: "POST",
                    url: ROUTE + 'jadwal/update',
                    data: 'latitude=' + latitude + '&longitude=' + longitude,
                    dataType: 'JSON'
                }).then(function () {
                    self.$el = $(self.el);
                    var table = self.$el.DataTable();
                    table.ajax.reload();
                })
            }.bind(this));
        } else {
            alert('Geolocation is not supported by this browser.');
        }
    }

    componentDidMount() {
        this.$el = $(this.el);
        this.$el.DataTable({
            processing: true,
            serverSide: true,
            bLengthChange: false,
            responsive: true,
            searching: false,
            paging: false,
            aLengthMenu: [[31], [31]],
            order: [],

            ajax: {
                "url": ROUTE + 'jadwal/json',
                "type": "POST",
                "headers": {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                },
            },

            columns: [
                {data: 'DT_RowIndex'},
                {data: 'tanggal'},
                {data: 'hijriah'},
                {data: 'imsak'},
                {data: 'subuh'},
                {data: 'fajar'},
                {data: 'dzuhur'},
                {data: 'ashar'},
                {data: 'maghrib'},
                {data: 'isya'},
            ]
        });
    }

    render() {
        return (
            <Fragment>
                <div className="layout-content-body">
                   <center>
                       <div className="warning">
                           <div className="label label-warning exit" style={{fontSize: '15px'}}>Silahkan ubah jadwal sholat berdasarkan lokasi dengan menekan tombol di bawah ini</div>
                           <br/><br/>
                       </div>
                   </center>
                    <button className="btn btn-info btn-sm" type="button" onClick={this.getCurrentLocation}
                            style={{marginBottom: '10px'}}><i className="icon icon-map-marker"></i> Set Location
                    </button>
                    <div className="row gutter-xs">
                        <div className="col-xs-12">
                            <div className="card">
                                <div className="card-header">
                                    <strong>Jadwal Sholat</strong>
                                </div>
                                <div className="card-body">
                                    <div className="table-responsive">
                                        <table id="demo-datatables"
                                               className="table table-striped table-hover table-nowrap dataTable"
                                               width="100%" ref={el => this.el = el}>
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Hijriah</th>
                                                <th>Imsak</th>
                                                <th>Subuh</th>
                                                <th>Terbit</th>
                                                <th>Dzuhur</th>
                                                <th>Ashar</th>
                                                <th>Maghrib</th>
                                                <th>Isya</th>
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
            </Fragment>
        )
    }
}

if (document.getElementById('jadwal')) {
    ReactDOM.render(<Jadwal/>, document.getElementById('jadwal'));
}
