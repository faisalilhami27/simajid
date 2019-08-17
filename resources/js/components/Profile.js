import React, {Component, Fragment} from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import {ROUTE} from './Route';

export default class Profile extends Component {
    constructor(props) {
        super(props);
        let user = JSON.parse(this.props.user);
        this.state = {
            id: user.id,
            nama: user.pengurus.nama,
            username: user.username,
            email: user.pengurus.email,
            no_hp: user.pengurus.no_hp,
            foto: ''
        };

        this.inputChange = this.inputChange.bind(this);
        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    inputChange(e) {
        this.setState({[e.target.name]: e.target.value});
    }

    handleChange(e) {
        this.setState({[e.target.name]: e.target.files[0]});
    }

    handleSubmit(e) {
        e.preventDefault();
        let nama = this.state.nama,
            username = this.state.username,
            email = this.state.email,
            noHp = this.state.no_hp,
            foto = this.state.foto,
            formData = new FormData();

        formData.append('nama', nama);
        formData.append('email', email);
        formData.append('username', username);
        formData.append('no_hp', noHp);
        formData.append('images', foto);

        axios({
            method: 'POST',
            url: ROUTE + 'profile/update',
            data: formData,
            dataType: 'JSON',
            cache: false,
            contentType: false,
            processData: false
        }).then(function (res) {
            notification(res.data.status, res.data.msg);
            setTimeout(function () {
                location.reload();
            }, 1000)
        }).catch(function (resp) {
            if (_.has(resp.response.data, 'errors')) {
                _.map(resp.response.data.errors, function (val, key) {
                    $('#' + key + '-error').html(val[0]).fadeIn(1000).fadeOut(5000);
                })
            }
            alert(resp.response.data.message)
        })

    }

    render() {
        return (
            <Fragment>
                <div className="layout-content-body">
                    <div className="row">
                        <div className="col-md-6">
                            <div className="panel m-b-lg">
                                <ul className="nav nav-tabs nav-justified">
                                    <li className="active tab1"><a href="#home-11" data-toggle="tab"><span
                                        style={{color: '#fff'}}>Data User</span></a>
                                    </li>
                                    <li><a href="#password-11" data-toggle="tab"><span
                                        style={{color: '#fff'}}>Change Password</span></a></li>
                                </ul>
                                <div className="tab-content">
                                    <div className="tab-pane fade active in" id="home-11">
                                        <div className="demo-form-wrapper">
                                            <form className="form form-horizontal" id="frm-website"
                                                  encType="multipart/form-data">
                                                <div className="form-group">
                                                    <label htmlFor="nama" className="col-sm-4">Nama Lengkap</label>
                                                    <div className="col-sm-8">
                                                        <div className="input-with-icon">
                                                            <input type="text" name="nama" className="form-control"
                                                                   autoComplete="off"
                                                                   id="nama"
                                                                   onChange={this.inputChange}
                                                                   value={this.state.nama}
                                                                   placeholder="Masukan nama" maxLength="60"/>
                                                            <span className="icon icon-user-secret input-icon"></span>
                                                            <span className="text-danger">
                                                                <strong id="nama-error"></strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div className="form-group">
                                                    <label htmlFor="username" className="col-sm-4">Username</label>
                                                    <div className="col-sm-8">
                                                        <div className="input-with-icon">
                                                            <input type="text" name="username"
                                                                   id="username"
                                                                   onChange={this.inputChange}
                                                                   value={this.state.username} className="form-control"
                                                                   autoComplete="off"
                                                                   placeholder="Masukan username" maxLength="20"/>
                                                            <span className="icon icon-user input-icon"></span>
                                                            <span className="text-danger">
                                                                <strong id="username-error"></strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div className="form-group">
                                                    <label htmlFor="email" className="col-sm-4">Email</label>
                                                    <div className="col-sm-8">
                                                        <div className="input-with-icon">
                                                            <input type="text" name="email" onChange={this.inputChange}
                                                                   value={this.state.email} className="form-control"
                                                                   autoComplete="off"
                                                                   id="email"
                                                                   placeholder="Masukan email" maxLength="50"/>
                                                            <span className="icon icon-envelope input-icon"></span>
                                                            <span className="text-danger">
                                                                <strong id="email-error"></strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div className="form-group">
                                                    <label htmlFor="password" className="col-sm-4">Nomor
                                                        Handphone</label>
                                                    <div className="col-sm-8">
                                                        <div className="input-with-icon">
                                                            <input type="text" name="no_hp" onChange={this.inputChange}
                                                                   className="form-control" autoComplete="off"
                                                                   id="no_hp"
                                                                   placeholder="Masukan No Hp" value={this.state.no_hp}
                                                                   maxLength="15"/>
                                                            <span className="icon icon-phone input-icon"></span>
                                                            <span className="text-danger">
                                                                <strong id="no_hp-error"></strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div className="form-group">
                                                    <label className="col-sm-4" htmlFor="form-control-5">Foto
                                                        Profile</label>
                                                    <div className="col-sm-8">
                                                        <div className="input-with-icon">
                                                            <div className="input-group input-file">
                                                                <input className="form-control" disabled type="text"
                                                                       placeholder="No file chosen"
                                                                       style={{backgroundColor: 'rgba(0,0,0, 0.1)'}}/>
                                                                <span className="icon icon-paperclip input-icon"></span>
                                                                <span className="input-group-btn">
                                                      <label className="btn btn-primary file-upload-btn">
                                                        <input id="foto" accept="image/*"
                                                               className="file-upload-input"
                                                               onChange={this.handleChange}
                                                               type="file" name="foto"/>
                                                        <span className="icon icon-paperclip icon-lg"></span>
                                                      </label>
                                                    </span>
                                                            </div>
                                                            <strong id="images-error"></strong>
                                                            <p className="help-block">
                                                                <small>Click the button next to the input field.</small>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button className="btn btn-primary" style={{marginLeft: '36%'}}
                                                        id="btn-update-data"
                                                        onClick={this.handleSubmit}
                                                        type="submit">Submit
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div className="tab-pane fade" id="password-11">
                                        <form className="form form-horizontal" id="form-reset" role="form">
                                            <div className="form-group">
                                                <label className="col-sm-4" htmlFor="form-control-1">Password</label>
                                                <div className="col-sm-8">
                                                    <div className="input-with-icon">
                                                        <div className="input-group">
                                                            <input className="form-control form-password" id="password"
                                                                   maxLength="12" type="password"
                                                                   placeholder="Password"/>
                                                            <span className="input-group-addon">
                                                            <label
                                                                className="custom-control custom-control-primary custom-checkbox">
                                                              <input className="custom-control-input form-checkbox"
                                                                     type="checkbox"/>
                                                              <span className="custom-control-indicator"></span>
                                                              <span className="custom-control-label">Show</span>
                                                            </label>
                                                    </span>
                                                        </div>
                                                        <span className="icon icon-lock input-icon"></span>
                                                        <span className="text-danger">
                                                        <strong id="password-error"></strong>
                                                </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div className="form-group">
                                                <label className="col-sm-4" htmlFor="form-control-1">Konfirmasi
                                                    Password</label>
                                                <div className="col-sm-8">
                                                    <div className="input-with-icon">
                                                        <div className="input-group">
                                                            <input className="form-control form-password1"
                                                                   id="konf_password"
                                                                   maxLength="12" type="password"
                                                                   placeholder="Konfirmasi Password"/>
                                                            <span className="input-group-addon">
                                                            <label
                                                                className="custom-control custom-control-primary custom-checkbox">
                                                              <input className="custom-control-input form-checkbox1"
                                                                     type="checkbox"/>
                                                              <span className="custom-control-indicator"></span>
                                                              <span className="custom-control-label">Show</span>
                                                            </label>
                                                    </span>
                                                        </div>
                                                        <span className="text-danger">
                                                            <strong id="password_confirmation-error"></strong>
                                                        </span>
                                                        <span className="icon icon-lock input-icon"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <button className="btn btn-primary"
                                                    style={{marginLeft: '36%', marginTop: '5%'}}
                                                    id="btn-reset-pass" type="submit">Submit
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="col-md-6">
                            <div className="panel m-b-lg">
                                <ul className="nav nav-tabs nav-justified">
                                    <li className="active tab1"><a href="#home-11" data-toggle="tab"><span
                                        style={{fontSize: '27px', fontWeight: 'bold'}}>Review Data User</span></a></li>
                                </ul>
                                <div className="tab-content">
                                    <div className="tab-pane fade active in" id="home-11">
                                        <div className="col-md-12">
                                            <img className="img-circle center-block"
                                                 src={this.props.data}
                                                 width="128px" height="128px"
                                                 style={{marginBottom: '5%', border: '2px solid #fff'}} alt="Profile"/>
                                        </div>
                                        <div className="card-body">
                                            <h3 className="card-title text-center">{this.state.nama}</h3>
                                            <p className="card-text text-center">
                                                <small>{this.props.level}</small>
                                            </p>
                                            <p className="card-text text-center">
                                                <small>{this.state.no_hp}</small>
                                            </p>
                                            <p className="card-text text-center">
                                                <small>{this.state.email}</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </Fragment>
        );
    }
}

if (document.getElementById('profile')) {
    var data = document.getElementById('profile').getAttribute('data');
    var user = document.getElementById('profile').getAttribute('user');
    var level = document.getElementById('profile').getAttribute('level');
    ReactDOM.render(<Profile data={data} user={user} level={level}/>, document.getElementById('profile'));
}
