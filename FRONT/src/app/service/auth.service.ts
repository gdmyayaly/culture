import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { JwtHelperService } from "@auth0/angular-jwt";
import { Router } from '@angular/router';
import Swal from 'sweetalert2';
@Injectable({
  providedIn: 'root'
})
export class AuthService {
  // public url: string = "http://127.0.0.1:8000/";
  // private urls="http://127.0.0.1:8000/admin/infos";
  public url:string="http://www.culture.telectronsenegal.com/";
 private urls="http://www.culture.telectronsenegal.com/admin/infos";
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
  infosuser(){
    return this.http.post(this.urls, { observe: 'response' })
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
      this.loadutilisateur();
    }
    else if (this.role === "ROLE_COLLABORATEUR") {
      this.route.navigate(['/question']);
      this.isuser = true;
      this.isadmin = false;
      this.loadutilisateur();
    }
  }
  loadredirection() {
    this.role = localStorage.getItem('role');
    this.connecter = true;
    if (this.role === "ROLE_ADMIN") {
      this.isadmin = true;
      this.isuser = false;
      //this.route.navigate(['/collaborateur']);
      this.loadutilisateur();
    }
    else if (this.role === "ROLE_COLLABORATEUR") {
      //this.route.navigate(['/question']);
      this.isuser = true;
      this.isadmin = false;
      this.loadutilisateur();
    }
  }
  logout() {
    localStorage.removeItem('token');
    localStorage.removeItem('role');
    localStorage.removeItem('user');
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
      this.loadredirection();
    }
    else {
      this.logout();
      this.route.navigate(['/']);
    }
  }
  loadutilisateur(){
    if (localStorage.getItem('user')) {
      this.utilisateur=JSON.parse(localStorage.getItem('user'));
    }
    else{
      this.infosuser().subscribe(
        res=>{this.utilisateur=res;
          localStorage.setItem('user',JSON.stringify(this.utilisateur))
        //console.log(res);
        },
        error=>{
          console.log(error);
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Echec chargement de vos informations',
          })
        }
      )
    }

  }
}
