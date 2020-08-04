import { Component, OnInit } from '@angular/core';
import Swal from 'sweetalert2'
import { Router } from '@angular/router';
import { FormControl, Validators, FormGroup } from '@angular/forms';
import { AdminService } from 'src/app/service/admin.service';
@Component({
  selector: 'app-session',
  templateUrl: './session.component.html',
  styleUrls: ['./session.component.scss']
})
export class SessionComponent implements OnInit {

  all=false;
  crea=false;
  tech=false;
  academy=false;
  business=false;
  validform=false;

  constructor(private router:Router,private admin:AdminService) { }

  ngOnInit() {
  }
  session= new FormGroup({
    date:new FormControl('',Validators.required),
    team: new FormControl(''),
    concerner: new FormControl('')
  })
  
  cochertout(){
    if(this.all==true){
      this.crea=false;
      this.tech=false;
      this.academy=false;
     // this.business=false;
      this.all=false;
    }
    else{
      this.crea=true;
      this.tech=true;
      this.academy=true;
     // this.business=true;
      this.all=true;
    }
  }

  cocheonce(data){
    if (data==='crea') {
      this.crea=!this.crea;
    }
    else if(data==='tech'){
      this.tech=!this.tech;
    }
    else if(data==='academy'){
      this.academy=!this.academy;
    }
    this.all=false;
    // else if(data==='business'){
    //   this.business=!this.business;
    // }
  }
  valid(){
    console.log(this.session.value);
    let a=[];
    if (this.crea) {
      a.push('Team Créa');
    }
    if(this.tech){
      a.push('Team Tech');
    }
    if(this.academy){
      a.push('grow Academy');
    }
    if (this.crea && this.tech && this.academy) {
      a=[];
      this.session.get('concerner').setValue("good");
      this.validform=true;
    }
    else{
      this.session.get('concerner').setValue("bad");
      if (this.crea || this.tech || this.academy) {
        this.validform=true;
      }
      else{
        this.validform=false;
      }
    }
    this.session.get('team').setValue(a);
    console.log(this.session.value);
    if (this.validform) {
      console.log("formulaire valid");
      this.admin.createsession(this.session.value).subscribe(
        res=>{console.log(res);
        },
        error=>{console.log(error);
        }
      )
    }
    else{
      console.log("formulaire invalid");
      
    }
    // Swal.fire({
    //   position: 'top-end',
    //   icon: 'success',
    //   title: 'Session creer avec success',
    //   showConfirmButton: false,
    //   timer: 1500
    // })
    //this.router.navigate(['/collaborateur'])
  }





}
