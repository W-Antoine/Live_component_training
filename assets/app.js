import { startStimulusApp } from '@symfony/stimulus-bridge';
import 'bootstrap/dist/css/bootstrap.min.css';
import './styles/app.css';

export const app = startStimulusApp(require.context(
    '@symfony/stimulus-bridge/lazy-controller-loader!./controllers',
    true,
    /\.[jt]sx?$/
));
