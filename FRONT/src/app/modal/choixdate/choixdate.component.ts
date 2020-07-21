import { Component, OnInit } from '@angular/core';
import { MatDialogRef } from '@angular/material/dialog';
import { AdminService } from 'src/app/service/admin.service';

@Component({
  selector: 'app-choixdate',
  templateUrl: './choixdate.component.html',
  styleUrls: ['./choixdate.component.scss']
})
export class ChoixdateComponent implements OnInit {

  constructor(public dialogRef: MatDialogRef<ChoixdateComponent>,public admin:AdminService) { }

  ngOnInit() {
  }
  choix(data){
    for (let index = 0; index < this.admin.alldate.length; index++) {
      if (this.admin.alldate[index].id==data) {
        if (this.admin.alldate[index].etat==false) {
          this.admin.alldate[index].etat=true
        }
        else{
          this.admin.alldate[index].etat=false;
        }
      }
      
    }
    console.log(data);
    this.admin.alldate
  }
  valider(){
    this.dialogRef.close();
  }
}
