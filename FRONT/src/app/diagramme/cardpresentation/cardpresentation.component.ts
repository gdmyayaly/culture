import { Component, OnInit } from '@angular/core';
import { AdminService } from 'src/app/service/admin.service';

@Component({
  selector: 'app-cardpresentation',
  templateUrl: './cardpresentation.component.html',
  styleUrls: ['./cardpresentation.component.scss']
})
export class CardpresentationComponent implements OnInit {
  general: number
  moyennegeneral: number
  moyenneteamautonomie: number
  moyenneteamcollaboration: number
  moyenneteamconfiance: number
  moyenneteamperformance: number
  moyenneteamperseverance: number
  moyenneteamproblemsolving: number
  moyenneteamtransmission: number
  moyenneuserautonomie: number
  moyenneusercollaboration: number
  moyenneuserconfiance: number
  moyenneuserperformance: number
  moyenneuserperseverance: number
  moyenneuserproblemsolving: number
  moyenneusertransmission: number
  teamautonomie: number
  teamcollaboration: number
  teamconfiance: number
  teamperformance: number
  teamperseverance: number
  teamproblemsolving: number
  teamtransmission: number
  userautonomie: number
  usercollaboration: number
  userconfiance: number
  userperformance: number
  userperseverance: number
  userproblemsolving: number
  usertransmission: number;
  public data:any;
  constructor(private admin:AdminService) { }

  ngOnInit() {
         console.log(this.admin.iduser);
        this.moyennegeneral=this.admin.donnerdatacarduser.moyennegeneral
        this.moyenneteamautonomie=this.admin.donnerdatacarduser.moyenneteamautonomie
        this.moyenneteamcollaboration=this.admin.donnerdatacarduser.moyenneteamcollaboration
        this.moyenneteamconfiance=this.admin.donnerdatacarduser.moyenneteamconfiance
        this.moyenneteamperformance=this.admin.donnerdatacarduser.moyenneteamperformance
        this.moyenneteamperseverance=this.admin.donnerdatacarduser.moyenneteamperseverance
        this.moyenneteamproblemsolving=this.admin.donnerdatacarduser.moyenneteamproblemsolving
        this.moyenneteamtransmission=this.admin.donnerdatacarduser.moyenneteamtransmission
        this.moyenneuserautonomie=this.admin.donnerdatacarduser.moyenneuserautonomie
        this.moyenneusercollaboration=this.admin.donnerdatacarduser.moyenneusercollaboration
        this.moyenneuserconfiance=this.admin.donnerdatacarduser.moyenneuserconfiance
        this.moyenneuserperformance=this.admin.donnerdatacarduser.moyenneuserperformance
        this.moyenneuserperseverance=this.admin.donnerdatacarduser.moyenneuserperseverance
        this.moyenneuserproblemsolving=this.admin.donnerdatacarduser.moyenneuserproblemsolving
        this.moyenneusertransmission=this.admin.donnerdatacarduser.moyenneusertransmission
        this.teamautonomie=this.admin.donnerdatacarduser.teamautonomie
        this.teamcollaboration=this.admin.donnerdatacarduser.teamcollaboration
        this.teamconfiance=this.admin.donnerdatacarduser.teamconfiance
        this.teamperformance=this.admin.donnerdatacarduser.teamperformance
        this.teamperseverance=this.admin.donnerdatacarduser.teamperseverance
        this.teamproblemsolving=this.admin.donnerdatacarduser.teamproblemsolving
        this.teamtransmission=this.admin.donnerdatacarduser.teamtransmission
        this.userautonomie=this.admin.donnerdatacarduser.userautonomie
        this.usercollaboration=this.admin.donnerdatacarduser.usercollaboration
        this.userconfiance=this.admin.donnerdatacarduser.userconfiance
        this.userperformance=this.admin.donnerdatacarduser.userperformance
        this.userperseverance=this.admin.donnerdatacarduser.userperseverance
        this.userproblemsolving=this.admin.donnerdatacarduser.userproblemsolving
        this.usertransmission=this.admin.donnerdatacarduser.usertransmission;
        this.general=this.admin.donnerdatacarduser.general;
        
  }

}
