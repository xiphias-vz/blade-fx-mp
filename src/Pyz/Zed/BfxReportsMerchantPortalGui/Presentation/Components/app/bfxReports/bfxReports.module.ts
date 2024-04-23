import { NgModule } from "@angular/core";
import { CommonModule } from "@angular/common";
import { HeadlineModule } from "@spryker/headline";

import { BfxReportsComponent } from "./bfxReports.component";

@NgModule({
    imports: [CommonModule, HeadlineModule],
    declarations: [BfxReportsComponent],
    exports: [BfxReportsComponent]

})
export class BfxReportsModule {}
