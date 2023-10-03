import moment from "moment";

const now = () => {
    return moment().format('YYYY-MM-DD');
}

const format = (dateString, format) => {
    const date = moment(dateString, "YYYY-MM-DDTHH:mm:ssZ").format(format);

    return date;
}

export default { now, format };
