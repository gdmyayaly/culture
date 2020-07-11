import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import Swal from 'sweetalert2';
import { AdminService } from 'src/app/service/admin.service';
@Component({
  selector: 'app-evaluation',
  templateUrl: './evaluation.component.html',
  styleUrls: ['./evaluation.component.scss']
})
export class EvaluationComponent implements OnInit {
  public id:any;
  public teamtech=[
    {username:'mbacke',prenom:"Elhadji Mbacke",nom:'Mbaye'},
    {username:'yaya',prenom:"El Hadji Yaya",nom:'Ly'},
    {username:'anta',prenom:"Adji Anta",nom:'Dabo'},
  ];
  public teamgrowacademy=[
    {username:'aissata',prenom:"Aissata",nom:'Déme'},
    {username:'fatou',prenom:"Fatou",nom:'Ndaw'},
    {username:'anta',prenom:"Adji Anta",nom:'Dabo'},
  ];
  public teamcrea=[
    {username:'abdoulaye',prenom:"Abdoulaye",nom:'Faye'},
    {username:'faustin',prenom:"Jean Jacques Faustin",nom:'Badji'},
    {username:'mbaye',prenom:"Mbaye",nom:'Sylla'},
  ];
  public teambusiness=[
    {username:'mah',prenom:"Mah Savane",nom:'Keita'},
    {username:'mamadou',prenom:"Mamadou",nom:'Ba'},
  ];
  public teamevaluation:any;
  public nomteam:any;
  public barrem=
  [
    {id:1,valeur:1},{id:2,valeur:2},{id:3,valeur:3},{id:4,valeur:4},{id:5,valeur:5}
  ]
  public resultat=
  [
    {id:0,libelle:'perseverance',valeur:null,style:'#FF4080'},
    {id:1,libelle:'confiance',valeur:null,style:'#FF4080'},
    {id:2,libelle:'collaboration',valeur:null,style:'#FF4080'},
    {id:3,libelle:'autonomie',valeur:null,style:'#FF4080'},
    {id:4,libelle:'problemsolving',valeur:null,style:'#FF4080'},
    {id:5,libelle:'transmission',valeur:null,style:'#FF4080'},
    {id:6,libelle:'performance',valeur:null,style:'#FF4080'},
  ];
  public good=false;
  constructor(private activeroute:ActivatedRoute,private admin:AdminService,private router:Router) { }

  ngOnInit() {
    this.id=this.activeroute.snapshot.paramMap.get('id');
    console.log(this.id);
    if (this.id==1) {
      this.teamevaluation=this.teambusiness;
      this.nomteam="Team Business";
    }
    else if(this.id==2){
      this.teamevaluation=this.teamgrowacademy;
      this.nomteam="grow academy";
    }
    else if(this.id==3){
      this.teamevaluation=this.teamcrea;
      this.nomteam="Team Créa";
    }
    else if(this.id==4){
      this.teamevaluation=this.teamtech;
      this.nomteam="Team Tech";
    }
    console.log(this.teamevaluation);
    
    
  }
  user= new FormGroup({
    nom:new FormControl('')
  })
  note= new FormGroup({
    perseverance:new FormControl('',Validators.required),
    confiance:new FormControl('',Validators.required),
    collaboration:new FormControl('',Validators.required),
    autonomie:new FormControl('',Validators.required),
    problemsolving:new FormControl('',Validators.required),
    transmission:new FormControl('',Validators.required),
    performance:new FormControl('',Validators.required),
    evaluer: new FormControl('')
  })
  reponse(partie,valeur){
    console.log(partie);
    console.log(valeur);
    this.note.get(partie).setValue(valeur);
    for (let index = 1; index <= valeur; index++) {
      let a=partie+index;
      document.getElementById(a).setAttribute('src','assets/etoiler.png');
      
    }
    for (let index = 0; valeur < 5; index++) {
      valeur++
      let a=partie+valeur;
      document.getElementById(a).setAttribute('src','assets/etoileg.png');
      
    }
  }
  validationdonner(){

      console.log(this.note.status);
      if (this.note.status=="VALID") {
        this.note.get('evaluer').setValue(this.user.get('nom').value);
        console.log(this.note.value);
        
        this.admin.note(this.note.value).subscribe(
          res=>{console.log(res);
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Merci',
              showConfirmButton: false,
              timer: 1500
            })
            this.router.navigate(['/question']);
          },
          error=>{console.log(error);
          }
        )
        console.log(this.user.value);
        

        
      }
      else{
      alert("Formulaire Ivalid")
      }
  }

}
