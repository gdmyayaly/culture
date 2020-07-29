import { Component, OnInit } from '@angular/core';
import { AdminService } from 'src/app/service/admin.service';

@Component({
  selector: 'app-article',
  templateUrl: './article.component.html',
  styleUrls: ['./article.component.scss']
})
export class ArticleComponent implements OnInit {
  public load=false;
  public publiction:any;
  constructor(private admin:AdminService) { }

  ngOnInit() {
    this.admin.listblog().subscribe(
      res=>{console.log(res);
        this.publiction=res;
      },
      eroor=>{console.log(eroor);
      }
    )
  }
  modifier(){
    alert("modification")
  }
}
