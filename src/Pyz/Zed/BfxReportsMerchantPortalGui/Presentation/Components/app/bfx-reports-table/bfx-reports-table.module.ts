import { NgModule } from "@angular/core";
import { CommonModule } from "@angular/common";
import { BfxReportsTableComponent } from './bfx-reports-table.component';
import { TableModule } from "@spryker/table";


@NgModule({
    imports: [CommonModule, TableModule],
    declarations: [BfxReportsTableComponent],
    exports: [BfxReportsTableComponent],
})
export class BfxReportsTableModule {}
