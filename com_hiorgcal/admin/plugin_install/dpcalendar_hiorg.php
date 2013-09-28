<?php
/**
 * @package		DPCalendarHiorg
 * @author		Digital Peak http://www.digital-peak.com
 * @copyright	Copyright (C) 2012 Digital Peak, Inc. All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl.html GNU/GPL
 */

defined('_JEXEC') or die();

JLoader::import('components.com_dpcalendar.libraries.dpcalendar.plugin', JPATH_ADMINISTRATOR);
if (! class_exists('DPCalendarPlugin')) {
    return;
}
class plgDPCalendarDPCalendar_Hiorg extends DPCalendarPlugin {
    
    
        protected $hiorg_url = "https://www.hiorg-server.de/termine.php?ical=1";

	protected $identifier = 'h';
        
        /*
        public function fetchEvent($eventId, $calendarId) {
            
            parent::fetchEvent($eventId, $calendarId);
        }
        
        public function onEventFetch($eventId) {
            $this->fetchEvent($eventId, 1);
            //die("2");
            //parent::onEventFetch($eventId);
        }
        public function onEventsFetch($calendarId, \JDate $startDate = null, \JDate $endDate = null, \JRegistry $options = null) {
            //die("3");
            parent::onEventsFetch($calendarId, $startDate, $endDate, $options);
        }
        
        public function fetchEvents($calendarId, \JDate $startDate = null, \JDate $endDate = null, \JRegistry $options) {
            //Geht!
            $out = parent::fetchEvents($calendarId, $startDate, $endDate, $options);
            //var_dump($out);
            return $out;
            //die("4");
        }
 
     
	public function fetchEvent($eventId, $calendarId) {
        $pos = strrpos($eventId, '_');
        if ($pos === false) {
            return null;
        }
        $s = substr($eventId, $pos + 1);

            $uid = substr($eventId, 0, $pos);
            $c = new vcalendar(array('unique_id' => 'DPCalendar'));
            $c->parse($this->getContent());

            while ( $event = $c->getComponent('vevent') ) {
                if ($event->getProperty('uid') != $uid) {
                    continue;
                }
                return $this->createEventFromIcal($event, $calendarId);
            }

	}
        */
        /*
	public function fetchEventss($calendarId, JDate $startDate = null, JDate $endDate = null , JRegistry $options) {
            //echo "FetchEvents";
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
        */
        
        
	public function fetchCalendars() {	
            $calendars = array();
	    $title = $this->params->get('title-1', null);
            $calendars[] = $this->createCalendar(1, $title, $this->params->get('description-1', ''), $this->params->get('color-1', 'A32929'));
            
            //var_dump($calendars);
            return $calendars;
                
	}
        
        
        
       protected function getContent($calendarId, JDate $startDate = null, JDate $endDate = null, JRegistry $options) {
        $uri = $this->hiorg_url."&ov=".$this->params->get('ov-1', null);
        $content = DPCalendarHelper::fetchContent(str_replace('webcal://', 'https://', $uri));

        $content = str_replace("BEGIN:VCALENDAR\r\n", '', $content);
        $content = str_replace("\r\nEND:VCALENDAR", '', $content);

        return "BEGIN:VCALENDAR\r\n" . $content . "\r\nEND:VCALENDAR";
    }
    
        public function onCalendarsFetch($calendarIds = null, $type = null) {
            //parent::onCalendarsFetch($calendarIds, $type);
            return $this->fetchCalendars();
        }
       
}