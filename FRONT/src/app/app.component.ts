import { Component, OnInit } from '@angular/core';
import { AuthService } from './service/auth.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent implements OnInit{
//  title = 'FRONT';
  constructor(public auth:AuthService) {
   }

  ngOnInit() {
    this.auth.reloadpage();
  }
}
