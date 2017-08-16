import React from 'react';
import style from './style.css';

class SessionList extends Component{
	constructor(props) {
		super(props);
		this.state = {
			sessions: [],
			loading: true
		}
	}

	componentWillMount() {
		fetch('http://localhost/drupal8_react/api/sessions')
		.then(res => res.json())
		.then(sessions => this.setState({
			loading:false,
			sessions:sessions
		}));
	}

	render(){
		let content = "Loading";
		if(this.state.loading === false && this.state.sessions.lenght > 0){
			content = this.state.sessions.map((session, index) => {
				return (
					<Session key={index} {... session} />
				)
			})
		}
		return (
			<div>{content}</div>
		)
	}
}