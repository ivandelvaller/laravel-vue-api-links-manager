export const checkField = (fieldString) => {
    if(!fieldString) {
        const message = `${fieldString.charAt(0).toUpperCase}${fieldString.slice(1).toLowerCase} is required.`;
        return [false, message];
    }
    return [true, "Valid field"];
};

export const checkLink = (link = "") => {
    const urlRegex = /http(?:s?):\/\/(?:www\.)?youtu(?:be\.com\/watch\?v=|\.be\/)([\w\-\_]*)(&(amp;)?‌​[\w\?‌​=]*)?/ig
    
    if(!link.match(urlRegex)) {
        return [false];
    }
    return [true];
};