import 'dayjs/locale/ru';
import dayjs  from "dayjs";
import relativeTime from 'dayjs/plugin/relativeTime';
export default function formatDate(date) {
    dayjs.locale('ru')
    dayjs.extend(relativeTime)
    return dayjs(date).fromNow()
}
export const DateNumber = (data) => {

    return  dayjs(data).format('YYYY. MM.DD')

}
