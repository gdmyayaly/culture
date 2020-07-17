import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class AdminService {
  public listteam=[
    {id:1,nom:'Team Business'},
    {id:2,nom:'grow academy'},
    {id:3,nom:'Team Créa'},
    {id:4,nom:'Team Tech&Digital'},
  ];
    public iduser={id:null};
    public userdetail:any;
    private url = "http://127.0.0.1:8000/admin/";
    public urlimage:string="http://127.0.0.1:8000/";
    // private url = "http://www.culture.telectronsenegal.com/admin/";
    // public urlimage:string="http://www.culture.telectronsenegal.com/";
    private urlnote="note";
    pri
  constructor(private http: HttpClient) { }
    public note(data){
      return this.http.post(this.url + this.urlnote, data, { observe: 'response' })
    }
}
