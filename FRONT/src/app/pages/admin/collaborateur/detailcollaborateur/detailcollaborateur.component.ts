import { Component, OnInit,ViewChild } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { AdminService } from 'src/app/service/admin.service';
import {MatSort} from '@angular/material/sort';
import {MatTableDataSource} from '@angular/material/table';
import * as $ from 'jquery';
export interface PeriodicElement {
  name: string;
  position: number;
  weight: number;
  symbol: string;
}

const ELEMENT_DATA: PeriodicElement[] = [
  {position: 1, name: 'Hydrogen', weight: 1.0079, symbol: 'H'},
  {position: 2, name: 'Helium', weight: 4.0026, symbol: 'He'},
  {position: 3, name: 'Lithium', weight: 6.941, symbol: 'Li'},
  {position: 4, name: 'Beryllium', weight: 9.0122, symbol: 'Be'},
  {position: 5, name: 'Boron', weight: 10.811, symbol: 'B'},
  {position: 6, name: 'Carbon', weight: 12.0107, symbol: 'C'},
  {position: 7, name: 'Nitrogen', weight: 14.0067, symbol: 'N'},
  {position: 8, name: 'Oxygen', weight: 15.9994, symbol: 'O'},
  {position: 9, name: 'Fluorine', weight: 18.9984, symbol: 'F'},
  {position: 10, name: 'Neon', weight: 20.1797, symbol: 'Ne'},
];
@Component({
  selector: 'app-detailcollaborateur',
  templateUrl: './detailcollaborateur.component.html',
  styleUrls: ['./detailcollaborateur.component.scss']
})
export class DetailcollaborateurComponent implements OnInit {
  displayedColumns: string[] = ['nom', 'general', 'progression'];
  

  @ViewChild(MatSort, {static: true}) sort: MatSort;
  public id:any;
  public personne:any;
  public classification:any;
  public good=false;
  public dataSource:any;
  general: number
  moyennegeneral: number
  moyenneteamautonomie: number
  moyenneteamcollaboration: number
  moyenneteamconfiance: number
  moyenneteamperformance: number
  moyenneteamperseverance: number
  moyenneteamproblemsolving: number
  moyenneteamtransmission: number
  moyenneuserautonomie: number
  moyenneusercollaboration: number
  moyenneuserconfiance: number
  moyenneuserperformance: number
  moyenneuserperseverance: number
  moyenneuserproblemsolving: number
  moyenneusertransmission: number
  teamautonomie: number
  teamcollaboration: number
  teamconfiance: number
  teamperformance: number
  teamperseverance: number
  teamproblemsolving: number
  teamtransmission: number
  userautonomie: number
  usercollaboration: number
  userconfiance: number
  userperformance: number
  userperseverance: number
  userproblemsolving: number
  usertransmission: number;
  public data:any;
  public datart:any;
  public date:any;
  public perseverances:any;
  public confiances:any;
  public collaborations:any;
  public autonomies:any;
  public problemsolvings:any;
  public transmissions:any;
  public performances:any;

  public moyenneperseverances:any;
  public moyenneconfiances:any;
  public moyennecollaborations:any;
  public moyenneautonomies:any;
  public moyenneproblemsolvings:any;
  public moyennetransmissions:any;
  public moyenneperformances:any;

  public teamperseverances:any;
  public teamconfiances:any;
  public teamcollaborations:any;
  public teamautonomies:any;
  public teamproblemsolvings:any;
  public teamtransmissions:any;
  public teamperformances:any;

  public moyenneteamperseverances:any;
  public moyenneteamconfiances:any;
  public moyenneteamcollaborations:any;
  public moyenneteamautonomies:any;
  public moyenneteamproblemsolvings:any;
  public moyenneteamtransmissions:any;
  public moyenneteamperformances:any;

  public barChartOptionsperseverance = {
    scaleShowVerticalLines: false,
    responsive: true,
    maintainAspectRatio:false,
    scales: {
      yAxes: [{
          ticks: {
              suggestedMin: 0,
              suggestedMax: 5,
              stepSize: 1
          },
          gridLines: {
            color: "rgba(0, 0, 0, 0)",
        }
      }],
      xAxes: [{
        gridLines: {
            color: "rgba(0, 0, 0, 0)",
        }
    }],
    }
  };
  public barChartLabelsperseverance:any;
  public barChartTypeperseverance :any;
  public barChartLegendperseverance:any;
  public barChartDataperseverance;
  public barChartOptionsconfiance = {
    scaleShowVerticalLines: false,
    responsive: true,
    maintainAspectRatio:false,

    scales: {
      yAxes: [{
          ticks: {
              suggestedMin: 0,
              suggestedMax: 5,
              stepSize: 1
          },
          gridLines: {
            color: "rgba(0, 0, 0, 0)",
        }
      }],
      xAxes: [{
        gridLines: {
            color: "rgba(0, 0, 0, 0)",
        }
    }],
    }
  };
  public barChartLabelsconfiance:any;
  public barChartTypeconfiance :any;
  public barChartLegendconfiance:any;
  public barChartDataconfiance;

  public barChartOptionscollaboration = {
    scaleShowVerticalLines: false,
    responsive: true,
    maintainAspectRatio:false,

    scales: {
      yAxes: [{
          ticks: {
              suggestedMin: 0,
              suggestedMax: 5,
              stepSize: 1
          },
          gridLines: {
            color: "rgba(0, 0, 0, 0)",
        }
      }],
      xAxes: [{
        gridLines: {
            color: "rgba(0, 0, 0, 0)",
        }
    }],
    }
  };
  public barChartLabelscollaboration:any;
  public barChartTypecollaboration :any;
  public barChartLegendcollaboration:any;
  public barChartDatacollaboration;

  public barChartOptionsautonomie = {
    scaleShowVerticalLines: false,
    responsive: true,
    maintainAspectRatio:false,

    scales: {
      yAxes: [{
          ticks: {
              suggestedMin: 0,
              suggestedMax: 5,
              stepSize: 1
          },
          gridLines: {
            color: "rgba(0, 0, 0, 0)",
        }
      }],
      xAxes: [{
        gridLines: {
            color: "rgba(0, 0, 0, 0)",
        }
    }],
    }
  };
  public barChartLabelsautonomie:any;
  public barChartTypeautonomie :any;
  public barChartLegendautonomie:any;
  public barChartDataautonomie;

  public barChartOptionsproblemsolving = {
    scaleShowVerticalLines: false,
    responsive: true,
    maintainAspectRatio:false,

    scales: {
      yAxes: [{
          ticks: {
              suggestedMin: 0,
              suggestedMax: 5,
              stepSize: 1
          },
          gridLines: {
            color: "rgba(0, 0, 0, 0)",
        }
      }],
      xAxes: [{
        gridLines: {
            color: "rgba(0, 0, 0, 0)",
        }
    }],
    }
  };
  public barChartLabelsproblemsolving:any;
  public barChartTypeproblemsolving :any;
  public barChartLegendproblemsolving:any;
  public barChartDataproblemsolving;

  public barChartOptionstransmission = {
    scaleShowVerticalLines: false,
    responsive: true,
    maintainAspectRatio:false,

    scales: {
      yAxes: [{
          ticks: {
              suggestedMin: 0,
              suggestedMax: 5,
              stepSize: 1
          },
          gridLines: {
            color: "rgba(0, 0, 0, 0)",
        }
      }],
      xAxes: [{
        gridLines: {
            color: "rgba(0, 0, 0, 0)",
        }
    }],
    }
  };
  public barChartLabelstransmission:any;
  public barChartTypetransmission :any;
  public barChartLegendtransmission:any;
  public barChartDatatransmission;

  public barChartOptionsperformance = {
    scaleShowVerticalLines: false,
    responsive: true,
    maintainAspectRatio:false,

    scales: {
      yAxes: [{
          ticks: {
              suggestedMin: 0,
              suggestedMax: 5,
              stepSize: 1
          },
          gridLines: {
            color: "rgba(0, 0, 0, 0)",
        }
      }],
      xAxes: [{
        gridLines: {
            color: "rgba(0, 0, 0, 0)",
        }
    }],
    }
  };
  public barChartLabelsperformance:any;
  public barChartTypeperformance :any;
  public barChartLegendperformance:any;
  public barChartDataperformance;


  constructor(private activeroute:ActivatedRoute,private admin:AdminService) { }

  ngOnInit() {
    if (!this.good) {
      this.id=this.activeroute.snapshot.paramMap.get('id');
    }
    
    //alert(this.id)
    let a={id:this.id};
    this.admin.iduser.id=this.id;
    this.personne=this.admin.userdetail;
   // this.loadtableau();
    this.loadcard();
    this.loadseven();
    this.loadtableau();
    var body = $("html, body");
    body.stop().animate({scrollTop:0}, 500, 'swing', function() { 
      // alert("Finished animating");
    });
  }
  retour(donner){
    console.log(donner);
    this.admin.userdetail=donner;
    this.id=donner.id;
    this.personne=donner;
    this.admin.iduser.id=this.id;
    console.log(this.id);
    this.loadcard();
    this.loadseven();
    var body = $("html, body");
body.stop().animate({scrollTop:0}, 500, 'swing', function() { 
  // alert("Finished animating");
});
  }
  loadcard(){
    this.admin.detailuser(this.admin.iduser).subscribe(
      res=>{console.log(res);
        this.data=res.body;
        this.general=this.data.general;
        this.moyennegeneral=this.data.moyennegeneral
        this.moyenneteamautonomie=this.data.moyenneteamautonomie
        this.moyenneteamcollaboration=this.data.moyenneteamcollaboration
        this.moyenneteamconfiance=this.data.moyenneteamconfiance
        this.moyenneteamperformance=this.data.moyenneteamperformance
        this.moyenneteamperseverance=this.data.moyenneteamperseverance
        this.moyenneteamproblemsolving=this.data.moyenneteamproblemsolving
        this.moyenneteamtransmission=this.data.moyenneteamtransmission
        this.moyenneuserautonomie=this.data.moyenneuserautonomie
        this.moyenneusercollaboration=this.data.moyenneusercollaboration
        this.moyenneuserconfiance=this.data.moyenneuserconfiance
        this.moyenneuserperformance=this.data.moyenneuserperformance
        this.moyenneuserperseverance=this.data.moyenneuserperseverance
        this.moyenneuserproblemsolving=this.data.moyenneuserproblemsolving
        this.moyenneusertransmission=this.data.moyenneusertransmission
        this.teamautonomie=this.data.teamautonomie
        this.teamcollaboration=this.data.teamcollaboration
        this.teamconfiance=this.data.teamconfiance
        this.teamperformance=this.data.teamperformance
        this.teamperseverance=this.data.teamperseverance
        this.teamproblemsolving=this.data.teamproblemsolving
        this.teamtransmission=this.data.teamtransmission
        this.userautonomie=this.data.userautonomie
        this.usercollaboration=this.data.usercollaboration
        this.userconfiance=this.data.userconfiance
        this.userperformance=this.data.userperformance
        this.userperseverance=this.data.userperseverance
        this.userproblemsolving=this.data.userproblemsolving
        this.usertransmission=this.data.usertransmission
      },
      error=>{
        console.log(error);
        
      }
    )
  }
  loadseven(){
    this.initialisationchart();
    this.admin.notesevenlastdays(this.admin.iduser).subscribe(
      res=>{
        //console.log(res.body);
        this.datart=res.body;
        //  console.log("rt");
        //  console.log(res);
         this.date=this.datart.date;
         this.perseverances=this.datart.perseverance;
         this.teamperseverances=this.datart.teamperseverance;
         this.chartPerseverance();
         this.confiances=this.datart.confiance;
         this.teamconfiances=this.datart.teamconfiance;
         this.chartConfiance();
         this.collaborations=this.datart.collaboration;
         this.teamcollaborations=this.datart.teamcollaboration;
         this.chartCollaboration();
         this.autonomies=this.datart.autonomie;
         this.teamautonomies=this.datart.teamautonomie;
         this.chartAutonomie();
         this.problemsolvings=this.datart.problemsolving;
         this.teamproblemsolvings=this.datart.teamproblemsolving;
         this.chartProblemsolving();
         this.transmissions=this.datart.transmission;
         this.teamtransmissions=this.datart.teamtransmission;
         this.chartTransmission();
         this.performances=this.datart.performance;
         this.teamperformances=this.datart.teamperformance;
         this.chartPerformance();
         this.loadmoyenne();
      },
      error=>{console.log(error);
      }
    )
  }
  loadmoyenne(){
    this.moyenneperseverances=0;
    this.moyenneconfiances=0;
    this.moyennecollaborations=0;
    this.moyenneautonomies=0;
    this.moyenneproblemsolvings=0;
    this.moyennetransmissions=0;
    this.moyenneperformances=0;
    this.moyenneteamperseverances=0;
    this.moyenneteamconfiances=0;
    this.moyenneteamcollaborations=0;
    this.moyenneteamautonomies=0;
    this.moyenneteamproblemsolvings=0;
    this.moyenneteamtransmissions=0;
    this.moyenneteamperformances=0;
    for (let index = 0; index < this.perseverances.length; index++) {
      this.moyenneperseverances=this.moyenneperseverances+this.perseverances[index];
      this.moyenneconfiances=this.moyenneconfiances+this.confiances[index];
      this.moyennecollaborations=this.moyennecollaborations+this.collaborations[index];
      this.moyenneautonomies=this.moyenneautonomies+this.autonomies[index];
      this.moyenneproblemsolvings=this.moyenneproblemsolvings+this.problemsolvings[index];
      this.moyennetransmissions=this.moyennetransmissions+this.transmissions[index];
      this.moyenneperformances=this.moyenneperformances+this.performances[index];
      this.moyenneteamperseverances=this.moyenneteamperseverances+this.teamperseverances[index];
      this.moyenneteamconfiances=this.moyenneteamconfiances+this.teamconfiances[index];
      this.moyenneteamcollaborations=this.moyenneteamcollaborations+this.teamcollaborations[index];
      this.moyenneteamautonomies=this.moyenneteamautonomies+this.teamautonomies[index];
      this.moyenneteamproblemsolvings=this.moyenneteamproblemsolvings+this.teamproblemsolvings[index];
      this.moyenneteamtransmissions=this.moyenneteamtransmissions+this.teamtransmissions[index];
      this.moyenneteamperformances=this.moyenneteamperformances+this.teamperformances[index];
    }
    this.moyenneperseverances=this.moyenneperseverances/7;
    this.moyenneconfiances=this.moyenneconfiances/7;
    this.moyennecollaborations=this.moyennecollaborations/7;
    this.moyenneautonomies=this.moyenneautonomies/7;
    this.moyenneproblemsolvings=this.moyenneproblemsolvings/7;
    this.moyennetransmissions=this.moyennetransmissions/7;
    this.moyenneperformances=this.moyenneperformances/7;
    this.moyenneteamperseverances=this.moyenneteamperseverances/7;
    this.moyenneteamconfiances=this.moyenneteamconfiances/7;
    this.moyenneteamcollaborations=this.moyenneteamcollaborations/7;
    this.moyenneteamautonomies=this.moyenneteamautonomies/7;
    this.moyenneteamproblemsolvings=this.moyenneteamproblemsolvings/7;
    this.moyenneteamtransmissions=this.moyenneteamtransmissions/7;
    this.moyenneteamperformances=this.moyenneteamperformances/7;
  }
  chartPerseverance(){
    console.log(this.perseverances);
    console.log(this.teamperseverances);
    this.barChartLabelsperseverance = this.date;
    this.barChartTypeperseverance = 'bar';
    this.barChartLegendperseverance = true;
    this.barChartDataperseverance = [
     {data: this.perseverances, label: 'User',backgroundColor: "#FF4080"},
     {data: this.teamperseverances, label: 'Team',backgroundColor: "grey", hoverBackgroundColor:"grey"},
     
   ];
  }

   chartConfiance(){
    this.barChartLabelsconfiance = this.date;
    this.barChartTypeconfiance = 'bar';
    this.barChartLegendconfiance = true;
    this.barChartDataconfiance = [
     {data: this.confiances, label: 'User',backgroundColor: "#FF4080"},
     {data: this.teamconfiances, label: 'Team',backgroundColor: "grey", hoverBackgroundColor:"grey"}
   ];
  }
 
  chartCollaboration(){
    this.barChartLabelscollaboration = this.date;
    this.barChartTypecollaboration = 'bar';
    this.barChartLegendcollaboration = true;
    this.barChartDatacollaboration = [
     {data: this.collaborations, label: 'User',backgroundColor: "#FF4080"},
     {data: this.teamcollaborations, label: 'Team',backgroundColor: "grey", hoverBackgroundColor:"grey"}
   ];
 }

 chartAutonomie(){
  this.barChartLabelsautonomie = this.date;
  this.barChartTypeautonomie = 'bar';
  this.barChartLegendautonomie = true;
  this.barChartDataautonomie = [
   {data: this.autonomies, label: 'User',backgroundColor: "#FF4080"},
   {data: this.teamautonomies, label: 'Team',backgroundColor: "grey", hoverBackgroundColor:"grey"}
 ];
 }

 chartProblemsolving(){
  this.barChartLabelsproblemsolving = this.date;
  this.barChartTypeproblemsolving = 'bar';
  this.barChartLegendproblemsolving = true;
  this.barChartDataproblemsolving = [
   {data: this.problemsolvings, label: 'User',backgroundColor: "#FF4080"},
   {data: this.teamproblemsolvings, label: 'Team',backgroundColor: "grey", hoverBackgroundColor:"grey"}
 ];
 }

 chartTransmission(){
  this.barChartLabelstransmission = this.date;
  this.barChartTypetransmission = 'bar';
  this.barChartLegendtransmission = true;
  this.barChartDatatransmission = [
   {data: this.transmissions, label: 'User',backgroundColor: "#FF4080"},
   {data: this.teamtransmissions, label: 'Team',backgroundColor: "grey"}
 ];
 }
 chartPerformance(){
  this.barChartLabelsperformance = this.date;
  this.barChartTypeperformance = 'bar';
  this.barChartLegendperformance = true;
  this.barChartDataperformance = [
   {data: this.performances, label: 'User',backgroundColor: "#FF4080"},
   {data: this.teamperformances, label: 'Team',backgroundColor: "grey",hoverBackgroundColor:"grey"}
 ];
  }

  initialisationchart(){
    this.barChartLabelsperseverance = ["2020", "2020", "2020", "2020", "2020", "2020", "2020"];
    this.barChartTypeperseverance = 'bar';
    this.barChartLegendperseverance = true;
    this.barChartDataperseverance = [
     {data: [0, 0, 0, 0, 0, 0, 0], label: 'P',backgroundColor: "#FF4080"},
     {data: [0, 0, 0, 0, 0, 0, 0], label: 'P',backgroundColor: "grey"}
    ];
  
    this.barChartLabelsconfiance = ["2020", "2020", "2020", "2020", "2020", "2020", "2020"];
    this.barChartTypeconfiance = 'bar';
    this.barChartLegendconfiance = true;
    this.barChartDataconfiance = [
     {data: [0, 0, 0, 0, 0, 0, 0], label: 'P',backgroundColor: "#FF4080"}
    ];
  
    this.barChartLabelscollaboration = ["2020", "2020", "2020", "2020", "2020", "2020", "2020"];
    this.barChartTypecollaboration = 'bar';
    this.barChartLegendcollaboration = true;
    this.barChartDatacollaboration = [
     {data: [0, 0, 0, 0, 0, 0, 0], label: 'P',backgroundColor: "#FF4080"}
    ];
  
    this.barChartLabelsautonomie = ["2020", "2020", "2020", "2020", "2020", "2020", "2020"];
    this.barChartTypeautonomie = 'bar';
    this.barChartLegendautonomie = true;
    this.barChartDataautonomie = [
     {data: [0, 0, 0, 0, 0, 0, 0], label: 'P',backgroundColor: "#FF4080"}
    ];
  
    this.barChartLabelsproblemsolving = ["2020", "2020", "2020", "2020", "2020", "2020", "2020"];
    this.barChartTypeproblemsolving = 'bar';
    this.barChartLegendproblemsolving = true;
    this.barChartDataproblemsolving = [
     {data: [0, 0, 0, 0, 0, 0, 0], label: 'P',backgroundColor: "#FF4080"}
    ];
  
    this.barChartLabelstransmission = ["2020", "2020", "2020", "2020", "2020", "2020", "2020"];
    this.barChartTypetransmission = 'bar';
    this.barChartLegendtransmission = true;
    this.barChartDatatransmission = [
     {data: [0, 0, 0, 0, 0, 0, 0], label: 'P',backgroundColor: "#FF4080"}
    ];
  
    this.barChartLabelsperformance = ["2020", "2020", "2020", "2020", "2020", "2020", "2020"];
    this.barChartTypeperformance = 'bar';
    this.barChartLegendperformance = true;
    this.barChartDataperformance = [
     {data: [0, 0, 0, 0, 0, 0, 0], label: 'P',backgroundColor: "#FF4080"}
    ];
  }
  loadtableau(){
    //displayedColumns: string[] = ['nom', 'general', 'progression'];
    this.admin.performaceteam().subscribe(
      res=>{console.log(res);
        this.classification=res;
        function compare(a, b) {
          // Use toUpperCase() to ignore character casing
          const bandA = a.general;
          const bandB = b.general;
        
          let comparison = 0;
          if (bandA > bandB) {
            comparison = -1;
          } else if (bandA < bandB) {
            comparison = 1;
          }
          return comparison;
        }
        
        this.classification.sort(compare);
        console.log(this.classification);
        
        this.dataSource = new MatTableDataSource(this.classification);
        this.dataSource.sort = this.sort;
        //this.dataSource=
       // this.classification.
      },
      error=>{console.log(error);
      }
    )

  }
}
