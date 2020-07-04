import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class AdminService {
    public iduser={id:null};
    private url = "http://127.0.0.1:8000/admin/";
    private urls="http://127.0.0.1:8000/infos/";
    public urlimage:string="http://127.0.0.1:8000/";
    // private url = "http://www.culture.telectronsenegal.com/admin/";
    // private urls="http://www.culture.telectronsenegal.com/infos/";
    // public urlimage:string="http://www.culture.telectronsenegal.com/";
  private urlusergrow = "usergrow";
  private urldetailuser="detailuser";
  private urllastevaluationdumois="lastevaluationdumois";
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
}
