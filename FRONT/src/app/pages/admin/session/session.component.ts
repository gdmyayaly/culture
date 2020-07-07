import { Component, OnInit } from '@angular/core';

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

  constructor() { }

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

  cocheonce(){
    if(this.all=true && this.academy==false || this.tech==false || this.business==false || this.crea==false ){
      this.all=false;
    }
  }






}
