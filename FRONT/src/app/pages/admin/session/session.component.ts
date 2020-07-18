import { Component, OnInit } from '@angular/core';
import Swal from 'sweetalert2'
import { Router } from '@angular/router';
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

  constructor(private router:Router) { }

  ngOnInit() {
  }

  cochertout(){
    if(this.all=true){
      this.crea=true;
      this.tech=true;
      this.academy=true;
      this.business=true;
    }
  }

  cocheonce(data){
    if(this.all=true && this.academy==false || this.tech==false || this.business==false || this.crea==false ){
      this.all=false;
    }
  }
  valid(){
    Swal.fire({
      position: 'top-end',
      icon: 'success',
      title: 'Session creer avec success',
      showConfirmButton: false,
      timer: 1500
    })
    this.router.navigate(['/collaborateur'])
  }





}
