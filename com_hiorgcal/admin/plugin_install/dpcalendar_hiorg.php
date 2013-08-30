<?php
/**
 * @package		DPCalendarHiorg
 * @author		Digital Peak http://www.digital-peak.com
 * @copyright           Copyright (C) 2012 Digital Peak, Inc. All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl.html GNU/GPL
 */

defined('_JEXEC') or die();

require_once (JPATH_ADMINISTRATOR.DS.'components'.DS.'com_dpcalendar'.DS.'helpers'.DS.'plugin.php');

require_once(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_dpcalendar'.DS.'libraries'.DS.'ical'.DS.'iCalcreator.class.php');

class plgDPCalendarDPCalendar_Hiorg extends DPCalendarPlugin {
    
    
        protected $hiorg_url = "http://www.hiorg-server.de/termine.php?ical=1";

	protected $identifier = 'i';

	public function fetchEvent($eventId, $calendarId) {
		$parts = explode('_', $eventId);
		if(empty($parts)) {
			return null;
		}
		$s = $parts[count($parts) - 1];
		$start = null;
		if(strlen($s) == 8) {
			$start = JFactory::getDate(substr($s, 0, 4).'-'.substr($s, 4, 2).'-'.substr($s, 6, 2).' 00:00');
		} else {
			$start = JFactory::getDate(substr($s, 0, 4).'-'.substr($s, 4, 2).'-'.substr($s, 6, 2).' '.substr($s, 8, 2).':'.substr($s, 10, 2));
		}
		$end = clone $start;
		$end->modify('+1 day');

		$tmpEvent = $this->createEvent($eventId, $calendarId);
		foreach ($this->fetchEvents($calendarId, $start, $end, new JRegistry()) as $event) {
			if($event->id == $tmpEvent->id) {
				return $event;
			}
		}
		return null;
	}

	public function fetchEvents($calendarId, JDate $startDate = null, JDate $endDate = null , JRegistry $options) {
		$params = $this->params;

		$v = new vcalendar(array('unique_id' => 'DPCalendar'));
		$content = $this->getContent($calendarId);
		if(empty($content)) {
			return array();
		}
		$v->parse($content);

		$timezone = null;
		while($vtz = $v->getComponent('vtimezone')) {
			$timezone = $vtz->getProperty('tzid');
		}

		if($startDate == null){
			$startDate = DPCalendarHelper::getDate();
		}
		if($endDate == null){
			$endDate = DPCalendarHelper::getDate();
			$endDate->modify('+5 year');
		}

		$startY = $startDate->format('Y');
		$startM = $startDate->format('m');
		$startD = $startDate->format('d');

		$endY = $endDate->format('Y');
		$endM = $endDate->format('m');
		$endD = $endDate->format('d');

		$data = $v->selectComponents($startY, $startM, $startD, $endY, $endM, $endD, false, false, true, false);
		$spanStart = $startY.'-'.$startM.'-'.$startD;
		$spanEnd = $endY.'-'.$endM.'-'.$endD;
		if(empty($data)) {
			return array();
		}
		$events = array();
		$filter = strtolower($options->get('filter', null));
		$limit = $options->get('limit', null);
		$start = $options->get('start', null);
		foreach($data as $yearArray) {
			foreach($yearArray as $month => $monthArray) {
				foreach($monthArray as $day => $dailyEventsArray) {
					foreach($dailyEventsArray as $event) {
						// if we don't expand the events we check the already added events
						if(!$options->get('expand', true) && key_exists($event->getProperty('uid'), $events)) {
							continue;
						}
						if(!empty($filter) && (
								strpos(strtolower($event->getProperty('summary')), $filter) === false &&
								strpos(strtolower($event->getProperty('description')), $filter) === false &&
								strpos(strtolower($event->getProperty('location')), $filter) === false
						)) {
							continue;
						}

						$tz = $timezone;

						$allDay = !key_exists('hour', $event->getProperty('dtstart'));

						$start = $event->getProperty('x-current-dtstart');
						if(empty($start) || !$options->get('expand', true)) {
							$v = $event->getProperty('dtstart');
							$start = array(1 => $v['year'].'-'.$v['month'].'-'.$v['day']);
							if(!$allDay){
								$start[1] = $start[1].' '.$v['hour'].':'.$v['min'].':'.$v['sec'];
							}
						}
						if(key_exists('TZID', $event->getProperty('dtstart'))) {
							$tz = $event->dtstart['params']['TZID'];
						}
						$startDate = DPCalendarHelper::getDate($start[1], $allDay, $allDay ? null : $tz);

						$end = $event->getProperty('x-current-dtend');
						if(empty($end) || !$options->get('expand', true)) {
							$v = $event->getProperty('dtend');
							$end = array(1 => $v['year'].'-'.$v['month'].'-'.$v['day']);
							if(!$allDay) {
								$end[1] = $end[1].' '.$v['hour'].':'.$v['min'].':'.$v['sec'];
							}
						}
						if(key_exists('TZID', $event->getProperty('dtend'))) {
							$tz = $event->dtend['params']['TZID'];
						}
						$endDate = DPCalendarHelper::getDate($end[1], $allDay, $allDay ? null : $tz);
						if($allDay) {
							$endDate->modify('-1 day');
						}

						$tmpEvent = $this->createEvent($event->getProperty('uid').'_'.($allDay ? $startDate->format('Ymd') : $startDate->format('YmdHi')), $calendarId);
						$tmpEvent->start_date = $startDate->toSql();
						$tmpEvent->end_date = $endDate->toSql();
						$tmpEvent->title = $event->getProperty('summary');
						$tmpEvent->description = $event->getProperty('description');
						$tmpEvent->location = $event->getProperty('location');
						$tmpEvent->all_day = $allDay;

						if(!$options->get('expand', true) && !empty($event->rrule)) {
							$tmpEvent->rrule = $event->rrule[0]['value'];
						}

						$tmpEvent->icalEvent = $event;

						if(!$options->get('expand', true)) {
							$events[$event->getProperty('uid')] = $tmpEvent;
						} else {
							$events[] = $tmpEvent;
						}

						if(!empty($limit) && count($events) >= $limit) {
							return $events;
						}
					}
				}
			}
		}
		return $events;
	}

	public function fetchCalendars($calendarIds = null) {
		$calendars = array();
		//for ($i = 1; $i < 11; $i++) {
			if(!empty($calendarIds) && !in_array($i, $calendarIds)) {
				continue;
			}
			$uri = $this->hiorg_url."&ov=".$this->params->get('ov-1', null);
                        //echo $uri;

			$title = $this->params->get('title-1', null);
			if(empty($uri) || empty($title)) {
				continue;
			}
			$calendars[] = $this->createCalendar(1, $title, $this->params->get('description-1', ''), $this->params->get('color-1', 'A32929'));
		//}
		return $calendars;
	}

	protected function getContent($calendarId) {
		$uri = $this->params->get('uri-'.$calendarId, '');
		return DPCalendarHelper::fetchContent($uri);
	}
}