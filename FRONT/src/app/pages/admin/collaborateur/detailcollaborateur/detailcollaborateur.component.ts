import { Component, OnInit,ViewChild } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { AdminService } from 'src/app/service/admin.service';
import {MatSort} from '@angular/material/sort';
import {MatTableDataSource} from '@angular/material/table';
import * as $ from 'jquery';
import { MatDialog } from '@angular/material/dialog';
import { ChoixdateComponent } from 'src/app/modal/choixdate/choixdate.component';
import { FormGroup, FormControl } from '@angular/forms';
@Component({
  selector: 'app-detailcollaborateur',
  templateUrl: './detailcollaborateur.component.html',
  styleUrls: ['./detailcollaborateur.component.scss']
})
export class DetailcollaborateurComponent implements OnInit {
  displayedColumns: string[] = ['nom', 'general', 'progression'];
  public ladate:any;
  public month = ["Janvier","février","mars","avril","mai","juin","juillet","août","septembre","octobre","novembre","décembre"];

  @ViewChild(MatSort, {static: true}) sort: MatSort;
  public id:any;
  public personne:any;
  public classification:any;
  public good=false;
  public dataSource:any;
  public loadcard=false;

  constructor(private activeroute:ActivatedRoute,private admin:AdminService,public dialog: MatDialog) {
    
   }

  ngOnInit() {
    var date=new Date();
    this.ladate=(this.month[date.getMonth()])+"/"+date.getFullYear();
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
    console.log(this.admin.iduser);
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
  donnerdate= new FormGroup({
    taille: new FormControl('')
  })
  choixdate(){
    const dialogRef = this.dialog.open(ChoixdateComponent, {
    });

    dialogRef.afterClosed().subscribe(result => {
      console.log('The dialog was closed');
      console.log(this.admin.alldate);
      let datatab=[];
      for (let index = 0; index < this.admin.alldate.length; index++) {
          if (this.admin.alldate[index].etat==true) {
            datatab.push(this.admin.alldate[index].id)
          }
      }
      console.log(datatab);
      this.donnerdate.get('taille').setValue(datatab.length)
      for (let index = 0; index < datatab.length; index++) {
        let a="id"+index;
        this.donnerdate.addControl(a,new FormControl(''))
        this.donnerdate.get(a).setValue(datatab[index])
      }
      console.log(this.donnerdate.value);
    });
  }
  loadnotesevenlastdays(){
    
  }

}
