import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl } from '@angular/forms';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/service/auth.service';
import Swal from 'sweetalert2';
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
        if (this.data.token) {
          this.auth.enregistrementToken(this.data.token);    
        }
        else{
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: this.data.message,
          })
        }
         
      },
      error=>{console.log(error);
        this.load=false;
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Probleme Serveur',
        })
      }
    )
  }
}
