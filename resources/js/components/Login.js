import React, {Component, Fragment} from 'react';
import ReactDOM from 'react-dom';
import {ROUTE} from "./Route";
import axios from 'axios';
import '../../../public/js/script';

export default class Login extends Component {
    constructor(props) {
        super(props);
        this.state = {
            token: '',
            username: '',
            password: ''
        };

        this.getToken = this.getToken.bind(this);
        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    getToken() {
        const token = $('meta[name="csrf-token"]').attr('content');
        this.setState({
            token: token
        })
    }

    handleChange(e) {
        this.setState({
            [e.target.name]: e.target.value
        })
    }

    componentDidMount() {
        this.getToken();
    }

    handleSubmit(e) {
        e.preventDefault();
        let username = this.state.username,
            passowrd = this.state.password;

        axios({
            method: 'post',
            url: ROUTE + 'staff/login',
            data: {
                "username" : username,
                "password" : passowrd
            },
            dataType: 'json'
        }).then(function (res) {
            if (res.data.status === 500) {
                notification(res.data.status, res.data.msg);
            } else {
                notification(200, "Login berhasil dan akan dialihkan ke halaman utama");
                setTimeout(function () {
                    $(location).attr('href', ROUTE + "choose/roles");
                }, 1000);
            }
        }.bind(this)).catch(function (resp) {
            if (_.has(resp.response.data, 'errors')) {
                _.map(resp.response.data.errors, function (val, key) {
                    $('#' + key + '-error').html(val[0]).fadeIn(1000).fadeOut(5000);
                })
            }
            alert(resp.response.data.message)
        });
    }

    render() {
        return (
            <Fragment>
                <div className="login-body">
                    <a className="login-brand">
                        <img className="img-responsive" src={ROUTE + "img/mesjid.png"} alt="Elephant" height="10px" />
                    </a>
                    <h5 className="login-heading" style={{textAlign: 'center'}}><b>Login Pengurus <span className="mosque-name"></span></b></h5>
                    <div className="login-form">
                        <form action="" method="post">
                            <input type="hidden" name="_token" value={this.state.token} />
                            <div className="form-group">
                                <label htmlFor="username">Username</label>
                                <div className="input-with-icon">
                                    <input id="username" onChange={this.handleChange} value={this.state.username} className="form-control" type="text" name="username"
                                           maxLength="20" autoComplete="off" autoFocus placeholder="Username : faisal27" required/>
                                    <span className="icon icon-user input-icon"></span>
                                    <span className="text-danger">
                                        <strong id="username-error"></strong>
                                    </span>
                                </div>
                            </div>
                            <div className="form-group">
                                <label htmlFor="password">Password</label>
                                <div className="input-with-icon">
                                    <input id="password" onChange={this.handleChange} value={this.state.password} className="form-control" type="password" maxLength="12"
                                           name="password" placeholder="password: barca1899" required/>
                                    <span className="icon icon-lock input-icon"></span>
                                    <span className="text-danger">
                                        <strong id="password-error"></strong>
                                    </span>
                                </div>
                            </div>
                            <button onClick={this.handleSubmit} className="btn btn-primary btn-block" id="btn-login" type="submit">
                                <span className="icon icon-sign-in"></span> Sign in
                            </button>
                        </form>
                    </div>
                </div>
            </Fragment>
        );
    }
}

if (document.getElementById('login')) {
    ReactDOM.render(<Login/>, document.getElementById('login'));
}
