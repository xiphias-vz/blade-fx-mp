import {ChangeDetectionStrategy, Component, ViewEncapsulation} from "@angular/core";

@Component({
    selector: 'mp-bfx-reports',
    templateUrl: './bfxReports.component.html',
    styleUrls: ['./bfxReports.component.less'],
    changeDetection: ChangeDetectionStrategy.OnPush,
    encapsulation: ViewEncapsulation.None,
})
export class BfxReportsComponent {}
