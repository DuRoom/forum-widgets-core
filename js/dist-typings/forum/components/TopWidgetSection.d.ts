import * as Mithril from 'mithril';
import Component from 'duroom/common/Component';
import Stream from 'duroom/common/utils/Stream';
export default class TopWidgetSection extends Component {
    scrollEnd: Stream;
    oninit(vnode: any): void;
    view(): Mithril.Children;
}
