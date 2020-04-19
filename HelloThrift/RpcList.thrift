namespace php RpcList

struct Arr{
1:string id,
2:string name,
3:string address
}
service Rpc {
     Arr getInfo(1:list<Arr> Arr)
}