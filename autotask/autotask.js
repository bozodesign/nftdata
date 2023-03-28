const { ethers } = require('ethers')
const {
    DefenderRelaySigner,
    DefenderRelayProvider,
} = require('defender-relay-client/lib/ethers')
/* global BigInt */
const CONTRACT_ADDRESS = '0x8038A1A649a30228D77063Cc937c917892737F11' //testnet
const ABI = [
    {
        inputs: [
            { internalType: 'address', name: '_to', type: 'address' },
            { internalType: 'uint256', name: '_tokenId', type: 'uint256' },
        ],
        name: 'mint',
        outputs: [{ internalType: 'uint256', name: '', type: 'uint256' }],
        stateMutability: 'nonpayable',
        type: 'function',
    },
]

// Entrypoint for the Autotask
exports.handler = async function (params) {
    const provider = new DefenderRelayProvider(params)
    const signer = new DefenderRelaySigner(params, provider, { speed: 'fast' })

    const { body, headers, queryParameters } = params.request
    const recipient = queryParameters.recipient
    const token = queryParameters.tokenId

    console.log(`Using relayer ${await signer.getAddress()}`)
    console.log('recipient:', recipient)
    console.log('token:', token)

    //Write withdraw function
    const contract = new ethers.Contract(CONTRACT_ADDRESS, ABI, signer)

    const tx = await contract.mint(recipient, token)
    console.log(`Called execute in ${tx.hash}`)
    return { tx: tx.hash }
}
