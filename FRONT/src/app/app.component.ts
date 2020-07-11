import { Component, OnInit } from '@angular/core';
import { AdminService } from './service/admin.service';
import { AuthService } from './service/auth.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent implements OnInit{
//  title = 'FRONT';
  constructor(private admin:AdminService,public auth:AuthService) { }

  ngOnInit() {
    this.admin.reloadpage();
    this.auth.reloadpage();
  }
}
