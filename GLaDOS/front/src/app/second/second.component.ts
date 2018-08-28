import { Component, OnInit } from '@angular/core';
import { DataService } from '../data.service';
import { Observable } from 'rxjs';

@Component({
  selector: 'app-second',
  templateUrl: './second.component.html',
  styleUrls: ['./second.component.css']
})
export class SecondComponent implements OnInit {

  foo$: Object;

  constructor(private data: DataService) { }

  ngOnInit() {
  	this.data.getData().subscribe(
      data => {this.foo$ = data; 
      console.log(this.foo$);
    });
  }

}
