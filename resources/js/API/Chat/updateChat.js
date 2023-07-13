/**
 * Send async request to update chat data
 *
 * @param {number} id
 * @param {string} title
 * @param {Number[]} users
 */
const updateChat = async (id, title, users) => {
    const response = await axios.post(
        route("chat.update", {
            id: id,
            title: title,
            users: users,
        })
    );

    return response.status === 200 && response.data.success;
};

export default updateChat;
