import { Component, OnInit,ViewChild } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { AdminService } from 'src/app/service/admin.service';
import {MatSort} from '@angular/material/sort';
import {MatTableDataSource} from '@angular/material/table';
import * as $ from 'jquery';
@Component({
  selector: 'app-detailcollaborateur',
  templateUrl: './detailcollaborateur.component.html',
  styleUrls: ['./detailcollaborateur.component.scss']
})
export class DetailcollaborateurComponent implements OnInit {
  displayedColumns: string[] = ['nom', 'general', 'progression'];
  

  @ViewChild(MatSort, {static: true}) sort: MatSort;
  public id:any;
  public personne:any;
  public classification:any;
  public good=false;
  public dataSource:any;
  public loadcard=false;

  constructor(private activeroute:ActivatedRoute,private admin:AdminService) {
    
   }

  ngOnInit() {
    this.id=this.activeroute.snapshot.paramMap.get('id');
    let a={id:this.id};
    this.admin.iduser.id=this.id;
    
    this.personne=this.admin.userdetail;
    var body = $("html, body");
    body.stop().animate({scrollTop:0}, 500, 'swing', function() { 
    });
    this.datacarduserload();
    this.loadtableau();
  }
  public datacarduserload(){
    this.admin.datacarduser(this.admin.iduser).subscribe(
      res=>{
        this.admin.donnerdatacarduser=res.body;
        console.log(this.admin.donnerdatacarduser);
        this.loadcard=true;
      },
      error=>{console.log(error);
      }
    )
  }
  loadtableau(){
    this.admin.performaceteam().subscribe(
      res=>{console.log(res);
        this.classification=res;
        function compare(a, b) {
          const bandA = a.general;
          const bandB = b.general;
        
          let comparison = 0;
          if (bandA > bandB) {
            comparison = -1;
          } else if (bandA < bandB) {
            comparison = 1;
          }
          return comparison;
        }
        
        this.classification.sort(compare);
        console.log(this.classification);
        
        this.dataSource = new MatTableDataSource(this.classification);
        this.dataSource.sort = this.sort;
      },
      error=>{console.log(error);
      }
    )

  }
  retour(donner){
    console.log(donner);
    this.admin.iduser.id=donner.id;
    console.log(this.admin.iduser.id);
    this.personne=donner;
    this.loadcard=false;
    this.datacarduserload();
    var body = $("html, body");
    body.stop().animate({scrollTop:0}, 500, 'swing', function() { 
    });
  }
}
