import { NgModule } from '@angular/core';
import {MatToolbarModule} from '@angular/material/toolbar';
import {MatIconModule} from '@angular/material/icon';
import {MatDividerModule} from '@angular/material/divider';
import {MatListModule} from '@angular/material/list';
import {MatButtonModule} from '@angular/material/button';

@NgModule({
	imports: [MatToolbarModule,MatIconModule,MatDividerModule,MatListModule,MatButtonModule],
	exports: [MatToolbarModule,MatIconModule,MatDividerModule,MatListModule,MatButtonModule]
})

export class MaterialModule {}