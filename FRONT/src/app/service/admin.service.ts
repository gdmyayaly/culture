import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class AdminService {
    public iduser={id:null};
    public userdetail:any;
    private url = "http://127.0.0.1:8000/admin/";
    private urls="http://127.0.0.1:8000/infos/";
    public urlimage:string="http://127.0.0.1:8000/";
    // private url = "http://www.culture.telectronsenegal.com/admin/";
    // private urls="http://www.culture.telectronsenegal.com/infos/";
    // public urlimage:string="http://www.culture.telectronsenegal.com/";
  private urlusergrow = "usergrow";
  private urldetailuser="datacarduser";
  private urllastevaluationdumois="lastevaluationdumois";
  private urldatacarduser="datacarduser";
  private urlnotesevenlastdays="notesevenlastdays";
  private urlperformaceteam="performaceteam";
  constructor(private http: HttpClient) { }
  
  usergrow() {
    return this.http.get(this.url + this.urlusergrow, { observe: 'response' })
  }
  detailuser(data){
    return this.http.post(this.url + this.urldetailuser,data, { observe: 'response' })
  }
  lastevaluationdumois(data){
    return this.http.post(this.url + this.urllastevaluationdumois,data, { observe: 'response' })
  }
  datacarduser(data){
    return this.http.post(this.url + this.urldatacarduser,data, { observe: 'response' })
  }
  notesevenlastdays(data){
    return this.http.post(this.url + this.urlnotesevenlastdays,data, { observe: 'response' })
  }
  performaceteam(){
    return this.http.post(this.url + this.urlperformaceteam, { observe: 'response' })
  }
  reloadpage(){
    if (localStorage.getItem('user')) {
      this.userdetail=JSON.parse(localStorage.getItem('user'));
    }
  }
}
