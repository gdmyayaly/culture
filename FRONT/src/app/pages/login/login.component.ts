import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl } from '@angular/forms';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/service/auth.service';
@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {
  public data:any;
  public load=false;
  constructor(private router:Router,private auth:AuthService) { }

  ngOnInit() {
  }
  utilisateur= new FormGroup({
    username: new FormControl(''),
    password: new FormControl('')
  })
  login(donner){
    console.log(donner);
    this.load=true;
    this.auth.logger(donner).subscribe(
      res=>{console.log(res);
        this.data=res.body;
        this.load=false;
        this.auth.enregistrementToken(this.data.token);     
      },
      error=>{console.log(error);
        this.load=false;
        alert("bakhoul")
      }
    )
    // if (donner.username=="director") {
    //   this.auth.connecter=true;
    //   this.auth.isadmin=true;
    //   localStorage.setItem('connecter',"good");
    //   localStorage.setItem('isadmin',"good");
    //   this.router.navigate(['collaborateur']);
    // }
    // else{
    //   this.auth.connecter=true;
    //   this.auth.isuser=true;
    //   localStorage.setItem('connecter',"good");
    //   localStorage.setItem('isadmin',"false");
    //   this.router.navigate(['collaborateur/detail',403]);
    // }
  }
}
