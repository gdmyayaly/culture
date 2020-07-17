import { Component, OnInit } from '@angular/core';
import { AdminService } from './service/admin.service';
import { AuthService } from './service/auth.service';
import {Router, NavigationStart, NavigationEnd,NavigationCancel, NavigationError, Event} from '@angular/router';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent implements OnInit{
//  title = 'FRONT';
  showLoadingIndicator = true;
  constructor(private admin:AdminService,public auth:AuthService,private _router: Router) {
    this._router.events.subscribe((routerEvent: Event) => {

      // On NavigationStart, set showLoadingIndicator to ture
      if (routerEvent instanceof NavigationStart) {
        this.showLoadingIndicator = true;
        console.log("chargement");
        
      }

      // On NavigationEnd or NavigationError or NavigationCancel
      // set showLoadingIndicator to false
      if (routerEvent instanceof NavigationEnd ||
        routerEvent instanceof NavigationError ||
        routerEvent instanceof NavigationCancel) {
          console.log("fin chargement");
        this.showLoadingIndicator = false;
      }

    });
   }

  ngOnInit() {
    this.admin.reloadpage();
    this.auth.reloadpage();
  }
}
