import { Component, OnInit } from '@angular/core';
import { Teampromo } from 'src/app/model/teampromo.model';
import { Router } from '@angular/router';
import { FormGroup, FormControl } from '@angular/forms';
import { AuthService } from './../../../../service/auth.service';
import { AdminService } from 'src/app/service/admin.service';
@Component({
  selector: 'app-ajoutcollaborateur',
  templateUrl: './ajoutcollaborateur.component.html',
  styleUrls: ['./ajoutcollaborateur.component.scss']
})
export class AjoutcollaborateurComponent implements OnInit {
  public list=[""];
  public listposte=[""]
  public nbrFichier = 0;
  public nbrFichierpost=0;
  public taille=0;
  public nombreteam:number=0;
  public nombreposte:number=0;
  public team=[
    {id:1,nom:'Team Tech'},
    {id:2,nom:'Team Créa'},
    {id:3,nom:'Team Academy'},
    {id:4,nom:'Team Business'},
  ];
  public job=[
    {id:1,nom:'Développeur web '},
    {id:2,nom:'Infographe'},
    {id:3,nom:'Monteur Cadreur'},
    {id:4,nom:'Business Manager'},
    {id:5,nom:'Project Manager'},

  ]; 
   public addgrow:boolean=false;
  public addteam:boolean=false;
  public fileToUpload: File=null;
  public message:any;
  public postename:string='';
  public teamtable=[];
  constructor(private router: Router,private auth:AuthService,public admin:AdminService) { }

  ngOnInit() {
  }
  user= new FormGroup({
    prenom: new FormControl(''),
    nom: new FormControl(''),
    telephone:new FormControl!(''),
    email:new FormControl(''),
    profil: new FormControl(''),
    team0: new FormControl(''),
    team:new FormControl(),
    taille: new FormControl(''),
    tailleposte: new FormControl(''),
    poste0: new FormControl(''),
    image:new FormControl('')
  });



    plusteam(){
      this.nombreteam++
      let e="team"+this.nombreteam;
      this.user.addControl(e,new FormControl());
      this.list.push("a");
      this.nbrFichier++;
      this.taille++;
    }
    plusposte(){
      let er:string="poste"+this.nombreposte;
     console.log(this.user.get(er));
      
     // console.log(this.user.value);
    //  
      this.nombreposte++;
      let e="poste"+this.nombreposte;
      this.user.addControl(e,new FormControl());
      this.listposte.push("a");
      this.nbrFichierpost++;
    }
    onAddFile() {
      this.nbrFichier++;
    }
  save(donner){
    console.log(donner);
    console.log(this.taille);
    console.log('nombreposte='+this.nombreposte);
    donner.tailleposte=this.nombreposte;
    donner.taille=this.taille;
   
  }
}
