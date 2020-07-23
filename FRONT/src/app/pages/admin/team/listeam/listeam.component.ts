import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { AdminService } from 'src/app/service/admin.service';

@Component({
  selector: 'app-listeam',
  templateUrl: './listeam.component.html',
  styleUrls: ['./listeam.component.scss']
})
export class ListeamComponent implements OnInit {
  public datatableau:any;
  public id:any;
  public nomteam:any;
  public datateam:any;
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

  public datart:any;
  public date:any;
  public perseverance:any;
  public confiance:any;
  public collaboration:any;
  public autonomie:any;
  public problemsolving:any;
  public transmission:any;
  public performance:any;

  public moyenneperseverance:any;
  public moyenneconfiance:any;
  public moyennecollaboration:any;
  public moyenneautonomie:any;
  public moyenneproblemsolving:any;
  public moyennetransmission:any;
  public moyenneperformance:any;

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


  constructor(private activeroute:ActivatedRoute,public admin:AdminService) { }

  ngOnInit() {
    this.id=this.activeroute.snapshot.paramMap.get('id');
    console.log(this.id);
    if (this.id==105) {
      let idteam={id:this.id};
      this.admin.datateam(idteam).subscribe(
        res=>{
          this.datateam=res.body;
          console.log(this.datateam);
          this.moyenneteamautonomie=this.datateam.moyenneteamautonomie;
          this.moyenneteamcollaboration=this.datateam.moyenneteamcollaboration;
          this.moyenneteamconfiance=this.datateam.moyenneteamconfiance;
          this.moyenneteamperformance=this.datateam.moyenneteamperformance;
          this.moyenneteamperseverance=this.datateam.moyenneteamperseverance;
          this.moyenneteamproblemsolving=this.datateam.moyenneteamproblemsolving;
          this.moyenneteamtransmission=this.datateam.moyenneteamtransmission;
          this.teamautonomie=this.datateam.teamautonomie;
          this.teamcollaboration=this.datateam.teamcollaboration;
          this.teamconfiance=this.datateam.teamconfiance;
          this.teamperformance=this.datateam.teamperformance;
          this.teamperseverance=this.datateam.teamperseverance;
          this.teamproblemsolving=this.datateam.teamproblemsolving;
          this.teamtransmission=this.datateam.teamtransmission;
          this.userautonomie=this.datateam.actuelautonomie;
          this.usercollaboration=this.datateam.actuelcollaboration;
          this.userconfiance=this.datateam.actuelconfiance;
          this.userperformance=this.datateam.actuelperformance;
          this.userperseverance=this.datateam.actuelperseverance;
          this.userproblemsolving=this.datateam.actuelproblemsolving;
          this.usertransmission=this.datateam.actueltransmission;
          this.general=this.datateam.actuelgeneral;

          this.moyenneuserautonomie=this.datateam.passerautonomie;
          this.moyenneusercollaboration=this.datateam.passercollaboration;
          this.moyenneuserconfiance=this.datateam.passerconfiance;
          this.moyenneuserperformance=this.datateam.passerperformance;
          this.moyenneuserperseverance=this.datateam.passerperseverance;
          this.moyenneuserproblemsolving=this.datateam.passerproblemsolving;
          this.moyenneusertransmission=this.datateam.passertransmission;
          this.moyennegeneral=this.datateam.passergeneral;
        },
        error=>{
          console.log(error);
          
        }
      )
      this.nomteam="Team Business";

      this.initialisationchart();
      this.admin.sevenlastevaluationteam(idteam).subscribe(
        res=>{
          this.datart=res.body;
           this.date=this.datart.date;
           this.perseverance=this.datart.perseverance;
           this.teamperseverances=this.datart.teamperseverance;
           this.chartPerseverance();
           this.confiance=this.datart.confiance;
           this.teamconfiances=this.datart.teamconfiance;
           this.chartConfiance();
           this.collaboration=this.datart.collaboration;
           this.teamcollaborations=this.datart.teamcollaboration;
           this.chartCollaboration();
           this.autonomie=this.datart.autonomie;
           this.teamautonomies=this.datart.teamautonomie;
           this.chartAutonomie();
           this.problemsolving=this.datart.problemsolving;
           this.teamproblemsolvings=this.datart.teamproblemsolving;
           this.chartProblemsolving();
           this.transmission=this.datart.transmission;
           this.teamtransmissions=this.datart.teamtransmission;
           this.chartTransmission();
           this.performance=this.datart.performance;
           this.teamperformances=this.datart.teamperformance;
           this.chartPerformance();
           
        },
        error=>{console.log(error);
        }
      )
    }
    else if(this.id==106){
      this.nomteam="grow academy";
      let idteam={id:this.id};
      this.admin.datateam(idteam).subscribe(
        res=>{
          this.datateam=res.body;
          console.log(this.datateam);
          
          
          this.moyenneteamautonomie=this.datateam.moyenneteamautonomie;
          this.moyenneteamcollaboration=this.datateam.moyenneteamcollaboration;
          this.moyenneteamconfiance=this.datateam.moyenneteamconfiance;
          this.moyenneteamperformance=this.datateam.moyenneteamperformance;
          this.moyenneteamperseverance=this.datateam.moyenneteamperseverance;
          this.moyenneteamproblemsolving=this.datateam.moyenneteamproblemsolving;
          this.moyenneteamtransmission=this.datateam.moyenneteamtransmission;
          this.teamautonomie=this.datateam.teamautonomie;
          this.teamcollaboration=this.datateam.teamcollaboration;
          this.teamconfiance=this.datateam.teamconfiance;
          this.teamperformance=this.datateam.teamperformance;
          this.teamperseverance=this.datateam.teamperseverance;
          this.teamproblemsolving=this.datateam.teamproblemsolving;
          this.teamtransmission=this.datateam.teamtransmission;
          this.userautonomie=this.datateam.actuelautonomie;
          this.usercollaboration=this.datateam.actuelcollaboration;
          this.userconfiance=this.datateam.actuelconfiance;
          this.userperformance=this.datateam.actuelperformance;
          this.userperseverance=this.datateam.actuelperseverance;
          this.userproblemsolving=this.datateam.actuelproblemsolving;
          this.usertransmission=this.datateam.actueltransmission;
          this.general=this.datateam.actuelgeneral;

          this.moyenneuserautonomie=this.datateam.passerautonomie;
          this.moyenneusercollaboration=this.datateam.passercollaboration;
          this.moyenneuserconfiance=this.datateam.passerconfiance;
          this.moyenneuserperformance=this.datateam.passerperformance;
          this.moyenneuserperseverance=this.datateam.passerperseverance;
          this.moyenneuserproblemsolving=this.datateam.passerproblemsolving;
          this.moyenneusertransmission=this.datateam.passertransmission;
          this.moyennegeneral=this.datateam.passergeneral;
        },
        error=>{
          console.log(error);
          
        }
      )
      this.initialisationchart();
      let a={id:403}
      this.admin.sevenlastevaluationteam(idteam).subscribe(
        res=>{
          this.datart=res.body;
          console.log(res.body);
          
           this.date=this.datart.date;
           this.perseverance=this.datart.perseverance;
           this.teamperseverances=this.datart.teamperseverance;
           this.chartPerseverance();
           this.confiance=this.datart.confiance;
           this.teamconfiances=this.datart.teamconfiance;
           this.chartConfiance();
           this.collaboration=this.datart.collaboration;
           this.teamcollaborations=this.datart.teamcollaboration;
           this.chartCollaboration();
           this.autonomie=this.datart.autonomie;
           this.teamautonomies=this.datart.teamautonomie;
           this.chartAutonomie();
           this.problemsolving=this.datart.problemsolving;
           this.teamproblemsolvings=this.datart.teamproblemsolving;
           this.chartProblemsolving();
           this.transmission=this.datart.transmission;
           this.teamtransmissions=this.datart.teamtransmission;
           this.chartTransmission();
           this.performance=this.datart.performance;
           this.teamperformances=this.datart.teamperformance;
           this.chartPerformance();
           
        },
        error=>{console.log(error);
        }
      )
    }
    else if(this.id==107){
      this.nomteam="Team Créa";
      let idteam={id:this.id};
      this.admin.datateam(idteam).subscribe(
        res=>{
          this.datateam=res.body;
          console.log(this.datateam);
          
          
          this.moyenneteamautonomie=this.datateam.moyenneteamautonomie;
          this.moyenneteamcollaboration=this.datateam.moyenneteamcollaboration;
          this.moyenneteamconfiance=this.datateam.moyenneteamconfiance;
          this.moyenneteamperformance=this.datateam.moyenneteamperformance;
          this.moyenneteamperseverance=this.datateam.moyenneteamperseverance;
          this.moyenneteamproblemsolving=this.datateam.moyenneteamproblemsolving;
          this.moyenneteamtransmission=this.datateam.moyenneteamtransmission;
          this.teamautonomie=this.datateam.teamautonomie;
          this.teamcollaboration=this.datateam.teamcollaboration;
          this.teamconfiance=this.datateam.teamconfiance;
          this.teamperformance=this.datateam.teamperformance;
          this.teamperseverance=this.datateam.teamperseverance;
          this.teamproblemsolving=this.datateam.teamproblemsolving;
          this.teamtransmission=this.datateam.teamtransmission;


          this.userautonomie=this.datateam.actuelautonomie;
          this.usercollaboration=this.datateam.actuelcollaboration;
          this.userconfiance=this.datateam.actuelconfiance;
          this.userperformance=this.datateam.actuelperformance;
          this.userperseverance=this.datateam.actuelperseverance;
          this.userproblemsolving=this.datateam.actuelproblemsolving;
          this.usertransmission=this.datateam.actueltransmission;
          this.general=this.datateam.actuelgeneral;

          this.moyenneuserautonomie=this.datateam.passerautonomie;
          this.moyenneusercollaboration=this.datateam.passercollaboration;
          this.moyenneuserconfiance=this.datateam.passerconfiance;
          this.moyenneuserperformance=this.datateam.passerperformance;
          this.moyenneuserperseverance=this.datateam.passerperseverance;
          this.moyenneuserproblemsolving=this.datateam.passerproblemsolving;
          this.moyenneusertransmission=this.datateam.passertransmission;
          this.moyennegeneral=this.datateam.passergeneral;
        },
        error=>{
          console.log(error);
          
        }
      )
      this.initialisationchart();
      let a={id:402}
      this.admin.sevenlastevaluationteam(idteam).subscribe(
        res=>{
          this.datart=res.body;
           this.date=this.datart.date;
           this.perseverance=this.datart.perseverance;
           this.teamperseverances=this.datart.teamperseverance;
           this.chartPerseverance();
           this.confiance=this.datart.confiance;
           this.teamconfiances=this.datart.teamconfiance;
           this.chartConfiance();
           this.collaboration=this.datart.collaboration;
           this.teamcollaborations=this.datart.teamcollaboration;
           this.chartCollaboration();
           this.autonomie=this.datart.autonomie;
           this.teamautonomies=this.datart.teamautonomie;
           this.chartAutonomie();
           this.problemsolving=this.datart.problemsolving;
           this.teamproblemsolvings=this.datart.teamproblemsolving;
           this.chartProblemsolving();
           this.transmission=this.datart.transmission;
           this.teamtransmissions=this.datart.teamtransmission;
           this.chartTransmission();
           this.performance=this.datart.performance;
           this.teamperformances=this.datart.teamperformance;
           this.chartPerformance();
           
        },
        error=>{console.log(error);
        }
      )
    }
    else if(this.id==108){
      this.nomteam="Team Tech";
      let idteam={id:this.id};
      this.admin.datateam(idteam).subscribe(
        res=>{
          this.datateam=res.body;
          console.log(this.datateam);
          
          
          this.moyenneteamautonomie=this.datateam.moyenneteamautonomie;
          this.moyenneteamcollaboration=this.datateam.moyenneteamcollaboration;
          this.moyenneteamconfiance=this.datateam.moyenneteamconfiance;
          this.moyenneteamperformance=this.datateam.moyenneteamperformance;
          this.moyenneteamperseverance=this.datateam.moyenneteamperseverance;
          this.moyenneteamproblemsolving=this.datateam.moyenneteamproblemsolving;
          this.moyenneteamtransmission=this.datateam.moyenneteamtransmission;
          this.teamautonomie=this.datateam.teamautonomie;
          this.teamcollaboration=this.datateam.teamcollaboration;
          this.teamconfiance=this.datateam.teamconfiance;
          this.teamperformance=this.datateam.teamperformance;
          this.teamperseverance=this.datateam.teamperseverance;
          this.teamproblemsolving=this.datateam.teamproblemsolving;
          this.teamtransmission=this.datateam.teamtransmission;
          this.userautonomie=this.datateam.actuelautonomie;
          this.usercollaboration=this.datateam.actuelcollaboration;
          this.userconfiance=this.datateam.actuelconfiance;
          this.userperformance=this.datateam.actuelperformance;
          this.userperseverance=this.datateam.actuelperseverance;
          this.userproblemsolving=this.datateam.actuelproblemsolving;
          this.usertransmission=this.datateam.actueltransmission;
          this.general=this.datateam.actuelgeneral;

          this.moyenneuserautonomie=this.datateam.passerautonomie;
          this.moyenneusercollaboration=this.datateam.passercollaboration;
          this.moyenneuserconfiance=this.datateam.passerconfiance;
          this.moyenneuserperformance=this.datateam.passerperformance;
          this.moyenneuserperseverance=this.datateam.passerperseverance;
          this.moyenneuserproblemsolving=this.datateam.passerproblemsolving;
          this.moyenneusertransmission=this.datateam.passertransmission;
          this.moyennegeneral=this.datateam.passergeneral;
        },
        error=>{
          console.log(error);
          
        }
      )
      this.initialisationchart();
      let a={id:412}
      this.admin.sevenlastevaluationteam(idteam).subscribe(
        res=>{
          this.datart=res.body;
           this.date=this.datart.date;
           this.perseverance=this.datart.perseverance;
           this.teamperseverances=this.datart.teamperseverance;
           this.chartPerseverance();
           this.confiance=this.datart.confiance;
           this.teamconfiances=this.datart.teamconfiance;
           this.chartConfiance();
           this.collaboration=this.datart.collaboration;
           this.teamcollaborations=this.datart.teamcollaboration;
           this.chartCollaboration();
           this.autonomie=this.datart.autonomie;
           this.teamautonomies=this.datart.teamautonomie;
           this.chartAutonomie();
           this.problemsolving=this.datart.problemsolving;
           this.teamproblemsolvings=this.datart.teamproblemsolving;
           this.chartProblemsolving();
           this.transmission=this.datart.transmission;
           this.teamtransmissions=this.datart.teamtransmission;
           this.chartTransmission();
           this.performance=this.datart.performance;
           this.teamperformances=this.datart.teamperformance;
           this.chartPerformance();
           //
        },
        error=>{console.log(error);
        }
      )
    }
    this.admin.performaceallteamcompare().subscribe(
      res=>{console.log(res);
        this.datatableau=res
      },
      error=>{console.log(error);
      }
    )
  }
  // loadmoyenne(){
  //   this.moyenneperseverance=0;
  //   this.moyenneconfiance=0;
  //   this.moyennecollaboration=0;
  //   this.moyenneautonomie=0;
  //   this.moyenneproblemsolving=0;
  //   this.moyennetransmission=0;
  //   this.moyenneperformance=0;
  //   this.moyenneteamperseverance=0;
  //   this.moyenneteamconfiance=0;
  //   this.moyenneteamcollaboration=0;
  //   this.moyenneteamautonomie=0;
  //   this.moyenneteamproblemsolving=0;
  //   this.moyenneteamtransmission=0;
  //   this.moyenneteamperformance=0;
  //   for (let index = 0; index < this.perseverance.length; index++) {
  //     this.moyenneperseverance=this.moyenneperseverance+this.perseverance[index];
  //     this.moyenneconfiance=this.moyenneconfiance+this.confiance[index];
  //     this.moyennecollaboration=this.moyennecollaboration+this.collaboration[index];
  //     this.moyenneautonomie=this.moyenneautonomie+this.autonomie[index];
  //     this.moyenneproblemsolving=this.moyenneproblemsolving+this.problemsolving[index];
  //     this.moyennetransmission=this.moyennetransmission+this.transmission[index];
  //     this.moyenneperformance=this.moyenneperformance+this.performance[index];
  //     this.moyenneteamperseverance=this.moyenneteamperseverance+this.teamperseverance[index];
  //     this.moyenneteamconfiance=this.moyenneteamconfiance+this.teamconfiance[index];
  //     this.moyenneteamcollaboration=this.moyenneteamcollaboration+this.teamcollaboration[index];
  //     this.moyenneteamautonomie=this.moyenneteamautonomie+this.teamautonomie[index];
  //     this.moyenneteamproblemsolving=this.moyenneteamproblemsolving+this.teamproblemsolving[index];
  //     this.moyenneteamtransmission=this.moyenneteamtransmission+this.teamtransmission[index];
  //     this.moyenneteamperformance=this.moyenneteamperformance+this.teamperformance[index];
  //   }
  //   this.moyenneperseverance=this.moyenneperseverance/7;
  //   this.moyenneconfiance=this.moyenneconfiance/7;
  //   this.moyennecollaboration=this.moyennecollaboration/7;
  //   this.moyenneautonomie=this.moyenneautonomie/7;
  //   this.moyenneproblemsolving=this.moyenneproblemsolving/7;
  //   this.moyennetransmission=this.moyennetransmission/7;
  //   this.moyenneperformance=this.moyenneperformance/7;
  //   this.moyenneteamperseverance=this.moyenneteamperseverance/7;
  //   this.moyenneteamconfiance=this.moyenneteamconfiance/7;
  //   this.moyenneteamcollaboration=this.moyenneteamcollaboration/7;
  //   this.moyenneteamautonomie=this.moyenneteamautonomie/7;
  //   this.moyenneteamproblemsolving=this.moyenneteamproblemsolving/7;
  //   this.moyenneteamtransmission=this.moyenneteamtransmission/7;
  //   this.moyenneteamperformance=this.moyenneteamperformance/7;
  // }
  chartPerseverance(){
    console.log(this.perseverance);
    console.log(this.teamperseverance);
    this.barChartLabelsperseverance = this.date;
    this.barChartTypeperseverance = 'bar';
    this.barChartLegendperseverance = true;
    this.barChartDataperseverance = [
     {data: this.perseverance, label: 'User',backgroundColor: "#FF4080"},
     {data: this.teamperseverances, label: 'Team',backgroundColor: "grey", hoverBackgroundColor:"grey"},
     
   ];
  }

   chartConfiance(){
    this.barChartLabelsconfiance = this.date;
    this.barChartTypeconfiance = 'bar';
    this.barChartLegendconfiance = true;
    this.barChartDataconfiance = [
     {data: this.confiance, label: 'User',backgroundColor: "#FF4080"},
     {data: this.teamconfiances, label: 'Team',backgroundColor: "grey", hoverBackgroundColor:"grey"}
   ];
  }
 
  chartCollaboration(){
    this.barChartLabelscollaboration = this.date;
    this.barChartTypecollaboration = 'bar';
    this.barChartLegendcollaboration = true;
    this.barChartDatacollaboration = [
     {data: this.collaboration, label: 'User',backgroundColor: "#FF4080"},
     {data: this.teamcollaborations, label: 'Team',backgroundColor: "grey", hoverBackgroundColor:"grey"}
   ];
 }

 chartAutonomie(){
  this.barChartLabelsautonomie = this.date;
  this.barChartTypeautonomie = 'bar';
  this.barChartLegendautonomie = true;
  this.barChartDataautonomie = [
   {data: this.autonomie, label: 'User',backgroundColor: "#FF4080"},
   {data: this.teamautonomies, label: 'Team',backgroundColor: "grey", hoverBackgroundColor:"grey"}
 ];
 }

 chartProblemsolving(){
  this.barChartLabelsproblemsolving = this.date;
  this.barChartTypeproblemsolving = 'bar';
  this.barChartLegendproblemsolving = true;
  this.barChartDataproblemsolving = [
   {data: this.problemsolving, label: 'User',backgroundColor: "#FF4080"},
   {data: this.teamproblemsolvings, label: 'Team',backgroundColor: "grey", hoverBackgroundColor:"grey"}
 ];
 }

 chartTransmission(){
  this.barChartLabelstransmission = this.date;
  this.barChartTypetransmission = 'bar';
  this.barChartLegendtransmission = true;
  this.barChartDatatransmission = [
   {data: this.transmission, label: 'User',backgroundColor: "#FF4080"},
   {data: this.teamtransmissions, label: 'Team',backgroundColor: "grey"}
 ];
 }
 chartPerformance(){
  this.barChartLabelsperformance = this.date;
  this.barChartTypeperformance = 'bar';
  this.barChartLegendperformance = true;
  this.barChartDataperformance = [
   {data: this.performance, label: 'User',backgroundColor: "#FF4080"},
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

}
