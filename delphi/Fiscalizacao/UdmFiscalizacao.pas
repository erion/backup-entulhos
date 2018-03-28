unit UdmFiscalizacao;

interface

uses
  SysUtils, Classes, DB, ADODB, Wwdatsrc, DBTables, Wwquery, Messages;

type
  TdmFiscalizacao = class(TDataModule)
    dbPmnh: TADOConnection;
    qryDenuncia: TADOQuery;
    dsDenuncia: TwwDataSource;
    qryLogin: TADOQuery;
    qryDenunciaSolicitacao: TADOQuery;
    tbSolicitacao: TADOTable;
    dsSolicitacao: TwwDataSource;
    tbSolicitacaoidsolicitacao: TIntegerField;
    tbSolicitacaoidtiporequerente: TIntegerField;
    tbSolicitacaoidusuario: TIntegerField;
    tbSolicitacaoidrequerente: TStringField;
    tbSolicitacaoidorigem: TIntegerField;
    tbSolicitacaoidtipoprotocolo: TIntegerField;
    tbSolicitacaonumprotocolo: TStringField;
    tbSolicitacaodataprotocolo: TDateTimeField;
    tbSolicitacaodatahorasolicitacao: TDateTimeField;
    tbSolicitacaoassunto: TStringField;
    tbSolicitacaoobservacao: TMemoField;
    qrySolicitacaoProtocolo: TADOQuery;
    qrySolicitacaoRequerente: TADOQuery;
    qrySolicitacaoRequerentedescricao: TStringField;
    qrySolicitacaoProtocolodescricao: TStringField;
    qrySolicitacaoOrigem: TADOQuery;
    qrySolicitacaoOrigemdescricao: TStringField;
    qrySolicitacaoRequerenteidtiporequerente: TIntegerField;
    qrySolicitacaoOrigemidorigem: TIntegerField;
    qrySolicitacaoProtocoloidtipoprotocolo: TIntegerField;
    tbDenuncia: TADOTable;
    dsCadDenuncia: TwwDataSource;
    tbDenunciaiddenuncia: TIntegerField;
    tbDenunciaidsolicitacao: TIntegerField;
    tbDenunciacodlotacao: TStringField;
    tbDenunciaidfiscal: TIntegerField;
    tbDenunciaidsituacao: TIntegerField;
    tbDenunciaidinfrator: TStringField;
    tbDenunciadatahoradenuncia: TDateTimeField;
    tbDenunciaassunto: TStringField;
    tbDenunciadescricao: TMemoField;
    tbDenunciaprocedimentos: TMemoField;
    tbDenunciadatahoraatendimento: TDateTimeField;
    tbDenunciaobservacao: TMemoField;
    tbDenunciaidbairroinfracao: TIntegerField;
    tbDenunciaidlogradouroinfracao: TIntegerField;
    tbDenuncianumeroinfracao: TStringField;
    tbDenunciacomplementoinfracao: TStringField;
    tbDenunciasetor: TStringField;
    tbDenunciaquadra: TIntegerField;
    tbDenuncialote: TIntegerField;
    tbDenunciaunidade: TStringField;
    qryCidadao: TADOQuery;
    qryCidadaonome_cidadao: TStringField;
    qryCidadaocod_cidadao: TIntegerField;
    qrySituacao: TADOQuery;
    qrySituacaoidsituacao: TIntegerField;
    qrySituacaodescricao: TStringField;
    qryLotacao: TADOQuery;
    qryLotacaocodlotacao: TStringField;
    qryLotacaonome: TStringField;
    qryLogradouro: TADOQuery;
    qryLogradourocod_logradouro: TIntegerField;
    qryLogradourodescricao: TStringField;
    qryBairro: TADOQuery;
    qryBairrocod_bairro: TSmallintField;
    qryBairronome: TStringField;
    tbNotificacao: TADOTable;
    dsNotificacao: TwwDataSource;
    tbNotificacaocodnotificacao: TStringField;
    tbNotificacaoiddenuncia: TIntegerField;
    tbNotificacaoidfiscal: TIntegerField;
    tbNotificacaoidsituacao: TIntegerField;
    tbNotificacaoidocorrencia: TIntegerField;
    tbNotificacaodatahoranotificacao: TDateTimeField;
    tbNotificacaoobservacao: TMemoField;
    tbNotificacaocodbaselegal: TIntegerField;
    dsCidadao: TwwDataSource;
    dsDenunciaSolicitacao: TwwDataSource;
    qry: TADOQuery;
    tbDenunciaNomeInfrator: TStringField;
    tbValoresChave: TADOTable;
    tbValoresChavecampo: TStringField;
    tbValoresChavevalor: TFloatField;
    qryValoresChave: TADOQuery;
    qryValoresChavecampo: TStringField;
    qryValoresChavevalor: TIntegerField;
    tbDenunciaNomeSecretaria: TStringField;
    qryVisualizaSolicitacao: TADOQuery;
    dsVisualizaSolicitacao: TwwDataSource;
    qryHistoricoInfrator: TADOQuery;
    dsHistoricoInfrator: TwwDataSource;
    qryVisualizaSolicitacaoidsolicitacao: TIntegerField;
    qryVisualizaSolicitacaorequerente: TStringField;
    qryVisualizaSolicitacaonome: TStringField;
    qryVisualizaSolicitacaotiporequerente: TStringField;
    qryVisualizaSolicitacaoorigem: TStringField;
    qryVisualizaSolicitacaotipoprotocolo: TStringField;
    qryVisualizaSolicitacaonumprotocolo: TStringField;
    qryVisualizaSolicitacaodataprotocolo: TDateTimeField;
    qryVisualizaSolicitacaodatahorasolicitacao: TDateTimeField;
    qryVisualizaSolicitacaoassunto: TStringField;
    qryVisualizaSolicitacaoobservacao: TMemoField;
    tbSolicitacaoRequerente: TStringField;
    qryDenunciadatahoradenuncia: TDateTimeField;
    qryDenunciaassunto: TStringField;
    qryDenunciarequerente: TStringField;
    qryDenunciainfrator: TStringField;
    qryDenunciaidinfrator: TStringField;
    qryDenunciadescricao: TStringField;
    qryDenunciaiddenuncia: TIntegerField;
    qryDenunciaidsolicitacao: TIntegerField;
    qryHistoricoInfrator2: TADOQuery;
    dsHistoricoInfrator2: TwwDataSource;
    qryHistoricoInfrator2codnotificacao: TStringField;
    qryHistoricoInfrator2datahoranotificacao: TDateTimeField;
    qryHistoricoInfrator2ocorrencianotificacao: TStringField;
    qryHistoricoInfrator2codautoinfracao: TStringField;
    qryHistoricoInfrator2datahorainfracao: TDateTimeField;
    qryHistoricoInfrator2codapreensao: TStringField;
    qryHistoricoInfrator2datahoraapreensao: TDateTimeField;
    qryLoginidusuario: TIntegerField;
    qryLogincodlotacao: TStringField;
    qryLoginnome: TStringField;
    qryLoginlogin: TStringField;
    qryLoginsenha: TStringField;
    qryLoginmatricula: TStringField;
    qryParametros: TADOQuery;
    qryParametrosiddenuncia: TIntegerField;
    qryParametroscodinfrator: TStringField;
    qryTemp: TADOQuery;
    dstemp: TwwDataSource;
    procedure tbSolicitacaoAfterInsert(DataSet: TDataSet);
    procedure tbSolicitacaoAfterCancel(DataSet: TDataSet);
    procedure tbSolicitacaoBeforePost(DataSet: TDataSet);
    procedure tbDenunciaBeforePost(DataSet: TDataSet);
    procedure dsHistoricoInfratorDataChange(Sender: TObject;
      Field: TField);
  private
    { Private declarations }

  public
    { Public declarations }

    function getValorCodigo(campo:string): integer;

  end;

var
  dmFiscalizacao: TdmFiscalizacao;

implementation

uses USolicitacao;

{$R *.dfm}

function TdmFiscalizacao.getValorCodigo(campo:string): integer;
begin
  With qryValoresChave do
  begin
    Close;
    Parameters.ParamByName('campo').Value:=campo;
    Open;
    Last;
    Edit;
    Fieldbyname('valor').Value:= Fieldbyname('valor').Value + 1;
    Post;
  end;
  Result := qryValoresChave.fieldbyname('valor').Value + 1;
end;

procedure TdmFiscalizacao.tbSolicitacaoAfterInsert(DataSet: TDataSet);
begin
  tbSolicitacaoidusuario.Value := qryLoginidusuario.Value;
end;

procedure TdmFiscalizacao.tbSolicitacaoAfterCancel(DataSet: TDataSet);
begin
  frmSolicitacao.Close;
end;

procedure TdmFiscalizacao.tbSolicitacaoBeforePost(DataSet: TDataSet);
begin
  if dsSolicitacao.State in [dsinsert] then
    tbSolicitacaoidSolicitacao.AsInteger := getValorCodigo('idsolicitacao');
end;

procedure TdmFiscalizacao.tbDenunciaBeforePost(DataSet: TDataSet);
begin
  if dsCaddenuncia.State in [dsinsert] then
    tbDenunciaiddenuncia.AsInteger := getValorCodigo('iddenuncia');
  tbDenunciaidsituacao.AsInteger := 1;
end;

procedure TdmFiscalizacao.dsHistoricoInfratorDataChange(Sender: TObject;
  Field: TField);
begin
  with qryParametros do
    begin
      Close;
      SQL.Text := 'select iddenuncia from fis_denuncia where iddenuncia in ' +
        '(select iddenuncia from fis_denuncia where idinfrator = ) ' + qryDenunciaidinfrator.AsString;
      Open;
    end;
  with qryHistoricoInfrator2 do
    begin
      Close;
      SQL.Text := 'select n.codnotificacao ' +
        ',      n.datahoranotificacao, o.descricao as ocorrenciaNotificacao ' +
        ',      a.codautoinfracao, a.datahorainfracao ' +
        ',      r.codapreensao, r.datahoraapreensao ' +
        'from   fis_notificacao n left join fis_autoinfracao a on ' +
        '         n.codnotificacao = a.codnotificacao left join fis_registroapreensao r on ' +
        '         n.codnotificacao = r.codnotificacao left join fis_ocorrencia o on ' +
        '         n.idocorrencia   = o.idocorrencia ' +
        ',      fis_denuncia d ' +
        'where  n.iddenuncia = ' + QuotedStr(dmFiscalizacao.qryParametrosiddenuncia.AsString) +
        'and    d.idinfrator = ' + QuotedStr(dmFiscalizacao.qryDenunciaidinfrator.AsString) +
        'and    n.iddenuncia = d.iddenuncia ' +
        ' order by n.codnotificacao ';
      Open;
    end;
end;

end.
