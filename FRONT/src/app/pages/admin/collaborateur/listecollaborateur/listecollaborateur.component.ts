import { Component, OnInit } from '@angular/core';
import { AdminService } from 'src/app/service/admin.service';
import { Router,NavigationEnd, NavigationStart  } from '@angular/router';
@Component({
  selector: 'app-listecollaborateur',
  templateUrl: './listecollaborateur.component.html',
  styleUrls: ['./listecollaborateur.component.scss']
})
export class ListecollaborateurComponent implements OnInit {
  public user:any;
  constructor(private admin:AdminService,private route:Router) { }

  ngOnInit() {
    this.routeEvent(this.route);
    this.admin.usergrow().subscribe(
      res=>{console.log(res);
        this.user=res.body
      },
      error=>{console.log(error);
      }
    )
  }
  routeEvent(router: Router){
    router.events.subscribe(e => {
      if(e instanceof NavigationEnd){
        console.log(e)
        console.log("good");
        
      }
      else if(e instanceof NavigationStart){
        console.log(e);
        console.log("parfait");
        
        
      }
    });
  }
  
  choix(user){
    this.admin.userdetail=user;
    localStorage.setItem('user',JSON.stringify(this.admin.userdetail));
  }
}
