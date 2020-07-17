import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { JwtHelperService } from "@auth0/angular-jwt";
import { Router } from '@angular/router';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  public url: string = "http://127.0.0.1:8000/";
  //public url:string="http://www.culture.telectronsenegal.com/";

  private urllogin: string = "login";
  public jwt: string;
  public role: any;
  public connecter = false;
  public utilisateur: any;
  public isadmin = false;
  public isuser = false;

  constructor(private http: HttpClient, private route: Router, public jwtHelper: JwtHelperService) { }
  logger(data) {
    return this.http.post(this.url + this.urllogin, data, { observe: 'response' })
  }
  enregistrementToken(jwtToken: string) {
    localStorage.setItem('token', jwtToken);
    this.jwt = jwtToken;
    let objet = this.jwtHelper.decodeToken(this.jwt);
    localStorage.setItem('role', objet.roles[0]);
    this.redirection();
  }
  redirection() {
    this.role = localStorage.getItem('role');
    this.connecter = true;
    if (this.role === "ROLE_ADMIN") {
      this.isadmin = true;
      this.isuser = false;
      this.route.navigate(['/collaborateur']);
    }
    else if (this.role === "ROLE_COLLABORATEUR") {
      this.route.navigate(['/question']);
      this.isuser = true;
      this.isadmin = false;
    }
  }
  logout() {
    localStorage.removeItem('token');
    localStorage.removeItem('role');
    this.connecter = false;
    this.isuser = false;
    this.isadmin = false;
  }
  getToken() {
    return this.jwt = localStorage.getItem('token');
  }

  public isAuthenticated(): boolean {
    const token = localStorage.getItem('token');
    return !this.jwtHelper.isTokenExpired(token);
  }
  reloadpage() {
    if (localStorage.getItem('token')) {
      this.redirection();
    }
    else {
      this.logout();
      this.route.navigate(['/']);
    }
  }
}
