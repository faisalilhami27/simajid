import React, {Component, Fragment} from 'react';
import ReactDOM from 'react-dom';
import {ROUTE} from "./Route";

export default class Login extends Component {
    constructor(props) {
        super(props);
        this.state = {
            token: '',
        };

        this.getToken = this.getToken.bind(this);
    }

    getToken() {
        const token = $('meta[name="csrf-token"]').attr('content');
        this.setState({
            token: token
        })
    }

    componentDidMount() {
        this.getToken();
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
                        <form action={ROUTE + "staff/login"} method="post">
                            <input type="hidden" name="_token" value={this.state.token} />
                            <div className="form-group">
                                <label htmlFor="username">Username</label>
                                <div className="input-with-icon">
                                    <input id="username" className="form-control" type="text" name="username"
                                           maxLength="20" autoComplete="off" autoFocus required/>
                                    <span className="icon icon-user input-icon"></span>
                                    <span className="text-danger">
                                        <strong id="username-error"></strong>
                                    </span>
                                </div>
                            </div>
                            <div className="form-group">
                                <label htmlFor="password">Password</label>
                                <div className="input-with-icon">
                                    <input id="password" className="form-control" type="password" maxLength="12"
                                           name="password" required/>
                                    <span className="icon icon-lock input-icon"></span>
                                    <span className="text-danger">
                                        <strong id="password-error"></strong>
                                    </span>
                                </div>
                            </div>
                            <button className="btn btn-primary btn-block" id="btn-login" type="submit">
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
