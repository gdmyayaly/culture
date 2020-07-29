import { Component, OnInit } from '@angular/core';
import * as $ from 'jquery';

@Component({
  selector: 'app-calendar',
  templateUrl: './calendar.component.html',
  styleUrls: ['./calendar.component.scss']
})
export class CalendarComponent implements OnInit {

  public date = new Date();
  public mois = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Décembre"];
  public jours = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];
  public donner = [];
  public model = { Lundi: { etat: false, valeur: null }, Mardi: { etat: false, valeur: null }, Mercredi: { etat: false, valeur: null }, Jeudi: { etat: false, valeur: null }, Vendredi: { etat: false, valeur: null }, Samedi: { etat: false, valeur: null }, Dimanche: { etat: false, valeur: null } };
  public rien = [];
  public maxdaynow = 0;
  public maxdaypast = 0;
  public maxdaynext=0;
  public moisactuel=null;
  public bordel=0;
  public isevaluation=[
    {date:'29/6/2020',text:'Evaluation par Team'},
    {date:'22/6/2020',text:'Evaluation par Team'},
    {date:'24/6/2020',text:'Evaluation par Team'},
    {date:'17/6/2020',text:'Evaluation par Team'},
    {date:'15/6/2020',text:'Evaluation par Team'},
    {date:'10/6/2020',text:'Evaluation par Team'},
    {date:'8/6/2020',text:'Evaluation par Team'},
  ]
  constructor() { }

  ngOnInit() {
    this.moisactuel=this.mois[this.date.getMonth()];
    this.maxdaynow = this.maxdaymois(this.date.getMonth());
    this.maxdaypast = this.maxdaymois((this.date.getMonth() - 1));
    this.maxdaynext = this.maxdaymois((this.date.getMonth() + 1));
    this.loadcalendrier(this.date.getFullYear(), this.date.getMonth());
    this.loadsession();
  }
  choix(){
    this.maxdaynow = this.maxdaymois(this.bordel);
    this.maxdaypast = this.maxdaymois((this.bordel - 1));
    this.maxdaynext = this.maxdaymois((this.bordel + 1));
    this.rien=[];
    this.loadcalendrier(2020, this.bordel);
    this.moisactuel=this.mois[this.bordel];
    this.bordel++;
  }
  loadcalendrier(annee, mois) {

    let premier = new Date(annee, mois, 1);
    console.log(premier.getDay());
    //Dimanche
    if (premier.getDay() == 0) {

      for (let index = 0; index < 6; index++) {
        let second = new Date(annee, (mois - 1), this.maxdaypast - index);
        this.rien.push({ issession:{statut:false,text:null},number: this.maxdaypast - index, etat: false, ladate: second.getDate() + '/' + second.getMonth() + '/' + annee });
      }
      for (let index = 1; index <= this.maxdaynow; index++) {
        let second = new Date(annee, mois, index);
        this.rien.push({ issession:{statut:false,text:null},number: index, etat: true, ladate: second.getDate() + '/' + second.getMonth() + '/' + annee });
      }
      for (let index = 0; index < (35-(6+this.maxdaynow)); index++) {
        let second = new Date(annee, (mois + 1), index);
        this.rien.push({ issession:{statut:false,text:null},number: (index+1), etat: true, ladate: second.getDate() + '/' + second.getMonth() + '/' + annee });
      }
    }
    //Lundi
    else if (premier.getDay() == 1) {
      for (let index = 1; index <= this.maxdaynow; index++) {
        let second = new Date(annee, mois, index);
        this.rien.push({ issession:{statut:false,text:null},number: index, etat: true, ladate: second.getDate() + '/' + second.getMonth() + '/' + annee });
      }
      for (let index = 0; index < (35-(this.maxdaynow)); index++) {
        let second = new Date(annee, (mois + 1), index);
        this.rien.push({ issession:{statut:false,text:null},number: (index+1), etat: true, ladate: second.getDate() + '/' + second.getMonth() + '/' + annee });
      }
    }
    //Mardi
    else if (premier.getDay() == 2) {
      for (let index = 0; index < 1; index++) {
        let second = new Date(annee, (mois - 1), this.maxdaypast - index);
        this.rien.push({ issession:{statut:false,text:null},number: this.maxdaypast - index, etat: false, ladate: second.getDate() + '/' + second.getMonth() + '/' + annee });
      }
      for (let index = 1; index <= this.maxdaynow; index++) {
        let second = new Date(annee, mois, index);
        this.rien.push({ issession:{statut:false,text:null},number: index, etat: true, ladate: second.getDate() + '/' + second.getMonth() + '/' + annee });
      }
      for (let index = 0; index < (35-(1+this.maxdaynow)); index++) {
let second = new Date(annee, (mois + 1), index);
        this.rien.push({ issession:{statut:false,text:null},number: (index+1), etat: true, ladate: second.getDate() + '/' + second.getMonth() + '/' + annee });
      }
    }
    //Mercredi
    else if (premier.getDay() == 3) {
      for (let index = 0; index < 2; index++) {
        let second = new Date(annee, (mois - 1), this.maxdaypast - index);
        this.rien.push({ issession:{statut:false,text:null},number: this.maxdaypast - index, etat: false, ladate: second.getDate() + '/' + second.getMonth() + '/' + annee });
      }
      for (let index = 1; index <= this.maxdaynow; index++) {
        let second = new Date(annee, mois, index);
        this.rien.push({ issession:{statut:false,text:null},number: index, etat: true, ladate: second.getDate() + '/' + second.getMonth() + '/' + annee });
      }
      for (let index = 0; index < (35-(2+this.maxdaynow)); index++) {
        let second = new Date(annee, (mois + 1), index);
        this.rien.push({ issession:{statut:false,text:null},number: (index+1), etat: true, ladate: second.getDate() + '/' + second.getMonth() + '/' + annee });
      }
    }
    //Jeudi
    else if (premier.getDay() == 4) {
      for (let index = 0; index < 3; index++) {
        let second = new Date(annee, (mois - 1), this.maxdaypast - index);
        this.rien.push({ issession:{statut:false,text:null},number: this.maxdaypast - index, etat: false, ladate: second.getDate() + '/' + second.getMonth() + '/' + annee });
      }
      for (let index = 1; index <= this.maxdaynow; index++) {
        let second = new Date(annee, mois, index);
        this.rien.push({ issession:{statut:false,text:null},number: index, etat: true, ladate: second.getDate() + '/' + second.getMonth() + '/' + annee });
      }
      for (let index = 0; index < (35-(3+this.maxdaynow)); index++) {
        let second = new Date(annee, (mois + 1), index);
        this.rien.push({ issession:{statut:false,text:null},number: (index+1), etat: true, ladate: second.getDate() + '/' + second.getMonth() + '/' + annee });
      }
    }
    //Vendredi
    else if (premier.getDay() == 5) {
      for (let index = 0; index < 4; index++) {
        let second = new Date(annee, (mois - 1), this.maxdaypast - index);
        this.rien.push({ issession:{statut:false,text:null},number: this.maxdaypast - index, etat: false, ladate: second.getDate() + '/' + second.getMonth() + '/' + annee });
      }
      for (let index = 1; index <= this.maxdaynow; index++) {
        let second = new Date(annee, mois, index);
        this.rien.push({ issession:{statut:false,text:null},number: index, etat: true, ladate: second.getDate() + '/' + second.getMonth() + '/' + annee });
      }
      for (let index = 0; index < (35-(4+this.maxdaynow)); index++) {
        let second = new Date(annee, (mois + 1), index);
        this.rien.push({ issession:{statut:false,text:null},number: (index+1), etat: true, ladate: second.getDate() + '/' + second.getMonth() + '/' + annee });
      }
    }
    //Samedi
    else if (premier.getDay() == 6) {
      for (let index = 0; index < 5; index++) {
        let second = new Date(annee, (mois - 1), this.maxdaypast - index);
        this.rien.push({ issession:{statut:false,text:null},number: this.maxdaypast - index, etat: false, ladate: second.getDate() + '/' + second.getMonth() + '/' + annee });
      }
      for (let index = 1; index <= this.maxdaynow; index++) {
        let second = new Date(annee, mois, index);
        this.rien.push({ issession:{statut:false,text:null},number: index, etat: true, ladate: second.getDate() + '/' + second.getMonth() + '/' + annee });
      }
    }
    for (let index = 0; index < (35-(5+this.maxdaynow)); index++) {
      let second = new Date(annee, (mois + 1), index);
      this.rien.push({ issession:{statut:false,text:null},number: (index+1), etat: true, ladate: second.getDate() + '/' + second.getMonth() + '/' + annee });
    }
  }
  maxdaymois(mois) {
    if (this.mois[mois] == "Janvier" || this.mois[mois] == "Mars" ||
this.mois[mois] == "Mai" || this.mois[mois] == "Juillet" ||
      this.mois[mois] == "Aout" || this.mois[mois] == "Octobre" ||
      this.mois[mois] == "Décembre") {
      return 31;
    }
    else if (this.mois[mois] == "Avril" || this.mois[mois] == "Juin" ||
      this.mois[mois] == "Septembre" || this.mois[mois] == "Novembre") {
      return 30;

    }
    else if (this.mois[mois] == "Février") {
      return 29;

    }
  }
  choixdays(ladate){
   // alert(ladate)
    //alert('dfdfdfs')
  }
  loadsession(){
    for (let index = 0; index < this.isevaluation.length; index++) {

      for (let indexe = 0; indexe < this.rien.length; indexe++) {
        if (this.rien[indexe].ladate==this.isevaluation[index].date) {
          this.rien[indexe].issession.statut=true;
          this.rien[indexe].issession.text=this.isevaluation[index].text;
        }
      }
    }

  }
}
