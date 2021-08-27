import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss']
})
export class HomeComponent implements OnInit {

  public intros: Array<String> = ["Encuentra una gran variedad de cursos sobre programación y desarrollo de apps.","Aprende a utilizar nuevas tecnologías con los mejores frameworks que existen.","Entrega de certificados autentificados para tu persona."];
  public intros2: Array<String> = ["Siempre se dispondrá de un profesor que te ayudará en todo momento.","Clases explicadas mediantes videos para que no te pierdas nunca.","Enseñanza agradable con comentarios y ejercicios."];
  constructor() { }

  ngOnInit() {
  }

}
