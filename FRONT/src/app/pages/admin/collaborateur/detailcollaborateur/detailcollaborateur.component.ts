import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { AdminService } from 'src/app/service/admin.service';

@Component({
  selector: 'app-detailcollaborateur',
  templateUrl: './detailcollaborateur.component.html',
  styleUrls: ['./detailcollaborateur.component.scss']
})
export class DetailcollaborateurComponent implements OnInit {
  public id:any;
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

  
  constructor(private activeroute:ActivatedRoute,private admin:AdminService) { }

  ngOnInit() {
    this.id=this.activeroute.snapshot.paramMap.get('id');
    //alert(this.id)
    let a={id:this.id};
    this.admin.iduser.id=this.id;
    this.admin.detailuser(a).subscribe(
      res=>{console.log(res);
        this.data=res.body;
        this.general=this.data.general;
        this.moyennegeneral=this.data.moyennegeneral
        this.moyenneteamautonomie=this.data.moyenneteamautonomie
        this.moyenneteamcollaboration=this.data.moyenneteamcollaboration
        this.moyenneteamconfiance=this.data.moyenneteamconfiance
        this.moyenneteamperformance=this.data.moyenneteamperformance
        this.moyenneteamperseverance=this.data.moyenneteamperseverance
        this.moyenneteamproblemsolving=this.data.moyenneteamproblemsolving
        this.moyenneteamtransmission=this.data.moyenneteamtransmission
        this.moyenneuserautonomie=this.data.moyenneuserautonomie
        this.moyenneusercollaboration=this.data.moyenneusercollaboration
        this.moyenneuserconfiance=this.data.moyenneuserconfiance
        this.moyenneuserperformance=this.data.moyenneuserperformance
        this.moyenneuserperseverance=this.data.moyenneuserperseverance
        this.moyenneuserproblemsolving=this.data.moyenneuserproblemsolving
        this.moyenneusertransmission=this.data.moyenneusertransmission
        this.teamautonomie=this.data.teamautonomie
        this.teamcollaboration=this.data.teamcollaboration
        this.teamconfiance=this.data.teamconfiance
        this.teamperformance=this.data.teamperformance
        this.teamperseverance=this.data.teamperseverance
        this.teamproblemsolving=this.data.teamproblemsolving
        this.teamtransmission=this.data.teamtransmission
        this.userautonomie=this.data.userautonomie
        this.usercollaboration=this.data.usercollaboration
        this.userconfiance=this.data.userconfiance
        this.userperformance=this.data.userperformance
        this.userperseverance=this.data.userperseverance
        this.userproblemsolving=this.data.userproblemsolving
        this.usertransmission=this.data.usertransmission
      },
      error=>{
        console.log(error);
        
      }
    )
    

  }
 

}
