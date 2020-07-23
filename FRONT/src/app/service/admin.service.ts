import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
@Injectable({
  providedIn: 'root'
})
export class AdminService {
  public alldate=[
    {id:2,mois:'février',annee:2020,etat:false},
    {id:3,mois:'mars',annee:2020,etat:false},
    {id:4,mois:'avril',annee:2020,etat:false},
    {id:5,mois:'mai',annee:2020,etat:false},
    {id:7,mois:'juillet',annee:2020,etat:false},
  ]
  public listteam=[
    {id:105,nom:'Team Business'},
    {id:106,nom:'grow academy'},
    {id:107,nom:'Team Créa'},
    {id:108,nom:'Team Tech&Digital'},
  ];
    public iduser={id:null};
    public userdetail:any;
    private url = "http://127.0.0.1:8000/admin/";
    public urlimage:string="http://127.0.0.1:8000/";
    // private url = "http://www.culture.telectronsenegal.com/admin/";
    // public urlimage:string="http://www.culture.telectronsenegal.com/";
    private urlnote="note";
    private urldatacarduser="datacarduser";
    public loadcard=false;
    public urlnotesevenlastdays="notesevenlastdays";
    public urllastevaluationdumois="lastevaluationdumois";
    public urlperformaceteam="performaceteam";
    public urldatateam="datateam";
    public urlsevenlastevaluationteam="sevenlastevaluationteam";
    public urlperformaceallteamcompare="performaceallteamcompare";
    public donnerdatacarduser={moyennegeneral:0,moyenneteamautonomie:0,moyenneteamcollaboration:0,moyenneteamconfiance:0,
      moyenneteamperformance:0,moyenneteamperseverance:0,moyenneteamproblemsolving:0,moyenneteamtransmission:0,
      moyenneuserautonomie:0,moyenneusercollaboration:0,moyenneuserconfiance:0,moyenneuserperformance:0,moyenneuserperseverance:0,
      moyenneuserproblemsolving:0,moyenneusertransmission:0,teamautonomie:0,teamcollaboration:0,teamconfiance:0,
      teamperformance:0,teamperseverance:0,teamproblemsolving:0,teamtransmission:0,userautonomie:0,
      usercollaboration:0,userconfiance:0,userperformance:0,userperseverance:0,userproblemsolving:0,usertransmission:0,general:0
    }
    public urlusergrow="usergrow";
  constructor(private http: HttpClient) { }
    public note(data){
      return this.http.post(this.url + this.urlnote, data, { observe: 'response' })
    }
    public datacarduser(data): Observable<any>{
      return this.http.post<any>(this.url + this.urldatacarduser, data, { observe: 'response' })
    }
    public usergrow(){
      return this.http.get(this.url + this.urlusergrow, { observe: 'response' })
    }
    public notesevenlastdays(data){
      return this.http.post(this.url + this.urlnotesevenlastdays,data, { observe: 'response' })
    }
    
    public lastevaluationdumois(data){
      return this.http.post(this.url + this.urllastevaluationdumois,data, { observe: 'response' })
    }
    public performaceteam(){
      return this.http.post(this.url + this.urlperformaceteam, { observe: 'response' })
    }
    public datateam(data): Observable<any>{
      return this.http.post<any>(this.url + this.urldatateam,data, { observe: 'response' })
    }
    public sevenlastevaluationteam(data) : Observable<any> {
      return this.http.post<any>(this.url + this.urlsevenlastevaluationteam,data, { observe: 'response' })
    }
    public performaceallteamcompare(){
      return this.http.post(this.url + this.urlperformaceallteamcompare, { observe: 'response' })
    }
}
