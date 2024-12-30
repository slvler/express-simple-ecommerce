const roles = require("../models/Roles.js");

const index = async (req, res) => {
    const result = await roles.find({});

    res.status(200).json({
        status: true,
        message: "success",
        data: result
    })
}

const create = async (req, res) => {
    const body = req.body;

    try {
        let role = new roles({
            role_name: body.role_name,
            is_active: true,
            created_by: req.user?.id
        });

        await role.save();

        res.status(201).json({
            status: true,
            message: "success",
            role: role
        });

    }catch (error){
        res.json(error)
    }
}

const update = async (req, res) => {
   try{
       let id = req.params.id;
       let body = req.body;

       await roles.updateOne({
           _id: id
       }, body);

       res.status(200).json({
           status: true,
           message: "success",
       })
   }catch (error){
       res.json(error)
   }

}


module.exports = {
    index,
    create,
    update
};
