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
  public personne:any;
  constructor(private activeroute:ActivatedRoute,private admin:AdminService) { }

  ngOnInit() {
    this.id=this.activeroute.snapshot.paramMap.get('id');
    //alert(this.id)
    let a={id:this.id};
    this.admin.iduser.id=this.id;
    this.personne=this.admin.userdetail;
  }
 

}
