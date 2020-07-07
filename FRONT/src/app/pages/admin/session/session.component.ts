import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-session',
  templateUrl: './session.component.html',
  styleUrls: ['./session.component.scss']
})
export class SessionComponent implements OnInit {

  checkall=false;
  checkcrea=false;
  checkteck=false;
  checkacademy=false;
  checkbusiness=false;
  constructor() { }

  ngOnInit() {
  }

  cochertout(){
      
  }
}
